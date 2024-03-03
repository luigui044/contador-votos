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
        @yield('contenedor')
    </div>
    @include('sweetalert::alert')
    @include('layouts.scripts')

</body>












</html>
