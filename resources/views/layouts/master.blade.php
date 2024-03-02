<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=+1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Sistema Contador de votos - SICE">
    @yield('recarga')
    @include('layouts.styles')
    <title>Counter 2024</title>
    @yield('csrf')

</head>
<form method="POST" id="salir" action="{{ route('logout') }}">
    @csrf
</form>

<body>
    <div class="container-fluid">
        <div class="row  mb-3">
            <div class="col-md-4 text-white">
                <h1><b><u>SICE - Módulo de Contador </u></b></h1>
            </div>
            <div class="col-md-8 text-right ">
                @if (auth()->user()->rol == 1)
                    <a href="{{ route('ingreso') }}" target="_blank" class="btn btn-mdb-color  font-weight-bold "><i
                            class="far fa-keyboard"></i> Registro de datos</a>
                    <a href="{{ route('dashboard') }}" target="_blank" class="btn btn-mdb-color font-weight-bold"><i
                            class="fas fa-chart-pie"></i> Gráficos de
                        resultados</a>
                @endif
                @if (auth()->user()->rol == 3 || auth()->user()->rol == 1)
                    {{-- <a href="{{ route('dashboardActas') }}" target="_blank"
                        class="btn btn-mdb-color font-weight-bold">Gráficos de
                        Actas</a> --}}
                @endif
                @if (auth()->user()->rol == 1 || auth()->user()->rol == 2)
                    <a href="{{ route('acta') }}" target="_blank" class="btn btn-indigo font-weight-bold"><i
                            class="fas fa-scroll"></i> Digitar
                        Acta</a>
                @endif




                <button form="salir" type="submit" class="btn btn-danger font-weight-bold">Logout</button>
            </div>


        </div>
    </div>

    <div class="container-fluid">
        @yield('contenedor')
    </div>
    @include('sweetalert::alert')
    @include('layouts.scripts')

</body>












</html>
