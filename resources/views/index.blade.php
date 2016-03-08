@extends('layouts.app',['jsFile' => 'index.js'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    @foreach($carreras as $carrera)
                        <a class="btn btn-info btn-carrera" href="{!! route('carreras.show',[ 'id' => $carrera->id ]) !!}">
                            <strong>{{ $carrera->nombre }}</strong>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection