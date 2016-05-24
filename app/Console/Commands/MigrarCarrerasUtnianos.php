<?php

namespace Utnianos\Core\Console\Commands;

use Config;
use Eloquent;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Utnianos\Core\Models\Carrera;
use Utnianos\Core\Models\Correlativa;
use Utnianos\Core\Models\Facultad;
use Utnianos\Core\Models\Materia;
use Utnianos\Core\Models\Plan;

class MigrarCarrerasUtnianos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrarCarreras';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $host = $this->ask('host:', 'localhost');
        $db = $this->ask('base de datos:', 'utnianos');
        $user = $this->ask('usuario:', 'root');
        $pass = $this->ask('password:', 'abrete');

        $utnianos = $this->crearConexion($host, $db, $user, $pass);
        $this->migrar($utnianos);

    }

    /**
     * @param $host
     * @param $db
     * @param $user
     * @param $pass
     * @return \Illuminate\Database\Connection
     */
    private function crearConexion($host, $db, $user, $pass)
    {
        Config::set('database.connections.utnianos_old', [
            'driver'    => 'mysql',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]);
        Config::set('database.connections.utnianos_old.host', $host);
        Config::set('database.connections.utnianos_old.database', $db);
        Config::set('database.connections.utnianos_old.username', $user);
        Config::set('database.connections.utnianos_old.password', $pass);

        return \DB::connection('utnianos_old');
    }

    private function migrar(Connection $utnianos)
    {
        Eloquent::unguard();

        $facultades = $this->importarFacultades($utnianos);
        $carreras = $this->importarCarreras($utnianos, $facultades);
        $planes = $this->importarPlanes($utnianos, $carreras);
        $materias = $this->importarMaterias($utnianos, $planes);
        $this->importarCorrelativas($utnianos, $planes, $materias);

        Eloquent::reguard();
    }

    /**
     * @param $utnianos
     * @return array
     */
    private function importarFacultades(Connection $utnianos)
    {
        $facultades = $utnianos->table('utnianos_facultades')->get();
        $this->info(PHP_EOL.'Importando facultades');

        //ahora solo necesito una excusa para llamar a una funcion foo
        $bar = $this->output->createProgressBar(count($facultades));

        $facultadesTrans = [];
        foreach ($facultades as $facultad) {
            $facultadesTrans[ $facultad->IdFacultad ] = Facultad::create(
                ['nombre' => $facultad->Nombre,
                'abreviatura' => $facultad->Abreviatura])
                ->id;
            $bar->advance();
        }

        return $facultadesTrans;
    }

    private function importarCarreras(Connection $utnianos, $facultades)
    {
        $carreras = $utnianos->table('utnianos_carreras')->get();
        $facultadesCarreras = collect(
            $utnianos->table('utnianos_facultadescarreras')->get())
            ->groupBy('IdCarrera');

        $this->info(PHP_EOL.'Importando carreras');
        $bar = $this->output->createProgressBar(count($carreras));

        $carrerasTrans = [];
        foreach ($carreras as $carrera) {
            $carreraNueva = Carrera::create([
                'nombre' => $carrera->Nombre,
                'abreviatura' => $carrera->Abreviatura]);

            $idsFacultades = $facultadesCarreras[ $carrera->IdCarrera ]
                ->pluck('IdFacultad')
                ->map(function($idViejo) use($facultades){
                    return $facultades[$idViejo];
                })->toArray();

            $carreraNueva->facultades()->sync($idsFacultades);
            $carreraNueva->save();
            $carrerasTrans[ $carrera->IdCarrera ] = $carreraNueva->id;
            $bar->advance();
        }

        return $carrerasTrans;
    }

    private function importarPlanes(Connection $utnianos, $carreras)
    {
        $planes = $utnianos->table('utnianos_planes')->get();
        $this->info(PHP_EOL.'Importando planes');

        $bar = $this->output->createProgressBar(count($planes));

        $planesTrans = [];
        foreach ($planes as $plan) {

            $planesTrans[ $plan->IdPlan ] = Plan::create(
                [ 'nombre'=> $plan->Nombre,
                  'carrera_id' => $carreras[ $plan->IdCarrera ] ])
                ->id;

            $bar->advance();
        }

        return $planesTrans;
    }

    /**
     * @param Connection $utnianos
     * @param $planes
     * @return array
     */
    private function importarMaterias(Connection $utnianos, $planes)
    {
        $materias = $utnianos->table('utnianos_materias')->get();
        $materiasPlanes = collect($utnianos
            ->table('utnianos_planesmaterias')->get())
                            ->groupBy('IdMateria');

        $this->info(PHP_EOL.'Importando materias');

        $bar = $this->output->createProgressBar(count($materias));

        $materiasTrans = [];
        foreach ($materias as $materia) {
            $materiaNueva = Materia::create(
                [ 'nombre' => $materia->Nombre,
                  'abreviatura' => $materia->Abreviatura,
                  'basica' => $materia->Basicas]);

            if (!$materiasPlanes->has($materia->IdMateria)) {
                $this->info(PHP_EOL.'Ignorando materia huerfana: id='.
                    $materia->IdMateria.' Nombre:'.$materia->Nombre );
                continue;
            }
            $p = [];
            foreach ($materiasPlanes[$materia->IdMateria] as $materiaPlan) {
                if (!isset($planes[ $materiaPlan->IdPlan ])) {
                    //el plan de esta relacion no existe
                    return [];
                }
                $p[ $planes[ $materiaPlan->IdPlan ] ] = [
                    'año' => $materiaPlan->Año,
                    'electiva' => $materiaPlan->Electiva
                ];
            }

            $materiaNueva->planes()->sync($p);
            $materiaNueva->save();

            $materiasTrans[ $materia->IdMateria ] = $materiaNueva->id;

            $bar->advance();
        }

        $bar->finish();

        return $materiasTrans;
    }

    /**
     * @param Connection $utnianos
     * @param $planes
     * @param $materias
     */
    private function importarCorrelativas(Connection $utnianos, $planes, $materias)
    {
        $correlativas = $utnianos->table('utnianos_correlativas')->get();

        $this->info(PHP_EOL.'Importando correlativas');

        $bar = $this->output->createProgressBar(count($correlativas));

        foreach ($correlativas as $correlativa) {
            if (!isset($planes[$correlativa->IdPlan]) ||
                !isset($materias[$correlativa->IdMateria]) ||
                !isset($materias[$correlativa->IdRequerimiento])) {
                continue;
            }

            $tipoRequerimiento = null;
            if ($correlativa->TipoMateria == 'C') {
                if ($correlativa->TipoRequerimiento == 'C') {
                    $tipoRequerimiento = Correlativa::CURSADA_CURSADA;
                }
                elseif ($correlativa->TipoRequerimiento == 'F') {
                    $tipoRequerimiento = Correlativa::CURSADA_FINAL;
                }
            }
            elseif ($correlativa->TipoMateria == 'F') {
                if ($correlativa->TipoRequerimiento == 'C') {
                    $tipoRequerimiento = Correlativa::FINAL_CURSADA;
                }
                elseif ($correlativa->TipoRequerimiento == 'F') {
                    $tipoRequerimiento = Correlativa::FINAL_FINAL;
                }
            }

            Correlativa::create([
                'plan_id' => $planes[$correlativa->IdPlan],
                'materia_id' => $materias[$correlativa->IdMateria],
                'requerimiento_id' => $materias[$correlativa->IdRequerimiento],
                'tipo_requerimiento' => $tipoRequerimiento]);


            $bar->advance();
        }

        $bar->finish();

    }
}
