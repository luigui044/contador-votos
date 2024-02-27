<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=+1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('recarga')
    @include('layouts.styles')    
<title>Counter 2021</title>
    @yield('csrf')

</head>
<form method="POST" id="salir" action="{{ route('logout') }}">
    @csrf
</form>

    <body>
        <div class="row">
            @if (auth()->user()->rol ==1)
                <a href="{{route('ingreso')}}" target="_blank" class="btn btn-info">Registro de datos</a>
                <a href="{{route('dashboard')}}" target="_blank"  class="btn btn-info">Gráficos de resultados</a>

            @endif
            @if (auth()->user()->rol ==3 || auth()->user()->rol ==1)
                <a href="{{route('dashboardActas')}}" target="_blank"  class="btn btn-warning">Gráficos de Actas</a>

            @endif
            @if (auth()->user()->rol ==1 || auth()->user()->rol ==2)
                
                <a  href="{{route('acta')}}" target="_blank" class="btn btn-success">Ingresar Acta</a>

            @endif
                



            <button form="salir" type="submit" class="btn btn-danger">Logout</button>

        </div>
            
        @yield('contenedor')
        @include('layouts.scripts')
        
      </body>












</html>