@extends('layouts.app',['jsFile' => 'carreras.js'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>{{ $carrera->nombre }}</h2>
            <ul>
                @foreach($carrera->planes as $plan)
                <li>
                    <strong>{{ $plan->nombre }}</strong>
                    <ul class="list-inline">
                    @foreach($plan->materias as $materia)
                        <li><a href="{!! route('materias.show',[ 'id' => $materia->id ]) !!}">{{ $materia->nombre }}</a></li>
                    @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection