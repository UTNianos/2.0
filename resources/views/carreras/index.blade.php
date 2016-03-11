@extends('layouts.app',['jsFile' => 'carreras.js'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>{{ $carrera->nombre }}</h1>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                @foreach($carrera->planes as $plan)
                    <li role="presentation"><a href="#plan-{{ $plan->id }}" aria-controls="plan-{{ $plan->id }}" role="tab" data-toggle="tab">{{ $plan->nombre }}</a></li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                @foreach($carrera->planes as $plan)
                    <div role="tabpanel" class="tab-pane" id="plan-{{ $plan->id }}">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <ul class="list-inline">
                                        @foreach($plan->materias as $materia)
                                            <li><a href="{!! route('materias.show',[ 'id' => $materia->id ]) !!}">{{ $materia->nombre }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection