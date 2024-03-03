@extends('layouts.master-user')
@section('cssmas')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <style>
        .oswald-text {
            font-family: "Oswald", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .oswald-text-h1 {
            font-family: "Oswald", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }
    </style>
@endsection
@section('contenedor')
    <div class="row justify-content-center align-items-center m-0 vh-100">

        <div class="col-md-12 text-center">
            <h1 class="oswald-text-h1 text-uppercase ">Sistema de conteo de votos</h1>
            <h3 class="oswald-text text-uppercase text-info">Bienvenid@ {{ auth()->user()->name }}</h3>

            <h3 class="oswald-text text-uppercase">Seleccione una opción</h3>
            <a href="{{ route('ingreso') }}" target="_blank" class="btn btn-mdb-color  font-weight-bold "><i
                    class="far fa-keyboard"></i> Registro Manual de Acta</a>
            <a href="{{ route('acta') }}" target="_blank" class="btn btn-indigo font-weight-bold"><i
                    class="fas fa-scroll"></i>
                Registro Fotográfico de Acta</a>
        </div>
    </div>
@endsection
