@extends('layouts.master-user')

@section('contenedor')
    <div class="row justify-content-center align-items-center m-0 vh-100">

        <div class="col-md-12 text-center">
            <h1>Seleccione una opción</h1>
            <a href="{{ route('ingreso') }}" target="_blank" class="btn btn-mdb-color  font-weight-bold "><i
                    class="far fa-keyboard"></i> Registro de datos</a>
            <a href="{{ route('acta') }}" target="_blank" class="btn btn-indigo font-weight-bold"><i class="fas fa-scroll"></i>
                Digitar Acta</a>
        </div>
    </div>
@endsection
