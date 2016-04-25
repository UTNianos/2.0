<?php

use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carrera = new \Utnianos\Core\Models\Carrera();
        $carrera->nombre = 'Ing en Fiestas y Jolgorios';
        $carrera->abreviatura = 'IFJ';
        $carrera->save();

        $plan = new \Utnianos\Core\Models\Plan();
        $plan->nombre = '98';
        $plan->carrera()->associate($carrera);
        $plan->save();

        $mat = new \Utnianos\Core\Models\Materia();
        $mat->nombre = 'Fiestas 1';
        $mat->basica = false;
        $mat->descripcion = '';
        $mat->save();
        $mat->planes()->save($plan);

    }
}
