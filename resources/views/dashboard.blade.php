@extends('layouts.master')
@section('recarga')
    <meta http-equiv="refresh" content="30">
@endsection

@section('cssmas')
    <style>
        body {
            background-color: #1d2d44;

        }

        #chartdiv {
            width: 100%;
            height: 600px;
            /* padding-left: 20px; */
        }

        #pastel {
            width: 100%;
            height: 450px;
        }

        #podometro,
        #podometro2 {
            width: 100%;
            height: 300px;
        }

        #barra {
            width: 100%;
            height: 450px;
        }
    </style>
@endsection

@include('footer')
@section('contenedor')
    <div class="row mb-3">

        <div class="col-md-4">
            <div id="chartdiv"></div>

        </div>
        <div class="col-md-4  align-self-center">
            <div id="podometro"></div>

        </div>
        <div class="col-md-4 align-self-center">
            <div id="podometro2"></div>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-md-5">


            <div id="pastel"></div>

        </div>
        <div class="col-md-6">
            <div id="barra"></div>
        </div>
    </div>
@endsection



@section('jsmas')
    <script src="{{ asset('amcharts/core.js') }}"></script>
    <script src="{{ asset('amcharts/charts.js') }}"></script>
    <script src="{{ asset('amcharts/maps.js') }}"></script>
    <script src="//www.amcharts.com/lib/4/themes/dark.js"></script>

    <script src="{{ asset('amcharts/themes/animated.js') }}"></script>

    <script src="{{ asset('assets/js/graficos.js') }}"></script>
@endsection
