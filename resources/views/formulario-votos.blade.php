@extends('layouts.master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contenedor')
    <div class="container-fluid">

        <h1 class="text-center">Formulario de contador de Votos</h1>
        <hr>
        <form action="{{ route('guardar') }}" id="formulario" method="POST">
            @csrf
            <div class="row">

                <div class="col-md-5">

                    <div class="form-group">
                        {{-- centro de votación --}}
                        <label for="centro">Centro de votación</label>
                        <select name="centro" id="centro" class="form-control" required>
                            <option value="">Seleccione centro de votación</option>
                            @foreach ($centros as $item)
                                <option value="{{ $item->id_centro }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Número JRBV --}}
                    <div class="form-group " id="filtrar">
                        <label for="jrv">Número de JRV</label>
                        <select name="jrv" id="jrv" class="form-control" disabled>
                            <option value="">seleccione número de JRV</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            {{-- total de papeletas entregadas --}}
                            <div class="form-group">
                                <label for="TPapeletas">Número de Papeletas entregadas</label>
                                <input type="text" name="TPapeletas" class="form-control soloNumeros" id="TPapeletas"
                                    required>
                            </div>
                            {{-- papeletas utilziadas --}}
                            <div class="form-group">
                                <label for="UPapeletas">Papeletas Utilizadas</label>
                                <input type="text" class="form-control soloNumeros" name="UPapeletas " id="UPapeletas"
                                    required>
                            </div>
                            {{-- papeltas sobrantes --}}
                            <div class="form-group">
                                <label for="SPapeletas">Papeletas Sobrantes
                                </label>
                                <input type="text" class="form-control soloNumeros" name="SPapeletas" id="SPapeletas"
                                    required>
                            </div>
                            {{-- papeltas inutlizadas --}}
                            <div class="form-group">
                                <label for="IPapeletas">Papeletas inutlizadas
                                </label>
                                <input type="text" class="form-control soloNumeros" name="IPapeletas" id="IPapeletas"
                                    required>
                            </div>
                            {{-- papeltas inutlizadas --}}
                            <div class="form-group">
                                <label for="EPapeletas">Papeletas Entregadas a votantes
                                </label>
                                <input type="text" class="form-control soloNumeros" name="EPapeletas" id="EPapeletas"
                                    required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            {{-- total de papeletas entregadas --}}
                            <div class="form-group">
                                <label for="VValidos">Votos válido</label>
                                <input type="text" name="VValidos" class="form-control soloNumeros" id="VValidos"
                                    required>
                            </div>
                            {{-- papeletas utilziadas --}}
                            <div class="form-group">
                                <label for="VNulos">Votos nulos</label>
                                <input type="text" class="form-control soloNumeros" name="VNulos" id="VNulos"
                                    required>
                            </div>
                            {{-- papeltas sobrantes --}}
                            <div class="form-group">
                                <label for="VImpugnados">Votos impugnados
                                </label>
                                <input type="text" class="form-control soloNumeros" name="VImpugnados" id="VImpugnados"
                                    required>
                            </div>
                            {{-- papeltas abstenciones --}}
                            <div class="form-group">
                                <label for="abstenciones">Abstenciones
                                </label>
                                <input type="text" class="form-control soloNumeros" name="abstenciones" id="abstenciones"
                                    required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-7">

                    @foreach ($candidatos as $item)
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="v{{ $item->id_candidato }}">Votos por rostro {{ $item->candidato }}
                                </label>
                                <input type="text" class="form-control soloNumeros"
                                    name="vCandidato{{ $item->id_candidato }}" id="v{{ $item->id_candidato }}"
                                    value="0"
                                    onchange="sumar('#v{{ $item->id_candidato }}','#vPartido{{ $item->id_candidato }}','#vAmbos{{ $item->id_candidato }}','#vTotal{{ $item->id_candidato }}')"required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="vpartido{{ $item->id_candidato }}">Votos por bandera {{ $item->candidato }}
                                </label>
                                <input type="text" class="form-control soloNumeros"
                                    name="vPartido{{ $item->id_candidato }}" id="vPartido{{ $item->id_candidato }}"
                                    value="0"
                                    onchange="sumar('#v{{ $item->id_candidato }}','#vPartido{{ $item->id_candidato }}','#vAmbos{{ $item->id_candidato }}','#vTotal{{ $item->id_candidato }}')"required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="vAmbos{{ $item->id_candidato }}">Votos en ambos {{ $item->candidato }}
                                </label>
                                <input type="text" class="form-control soloNumeros"
                                    name="vAmbos{{ $item->id_candidato }}" id="vAmbos{{ $item->id_candidato }}"
                                    value="0"
                                    onchange="sumar('#v{{ $item->id_candidato }}','#vPartido{{ $item->id_candidato }}','#vAmbos{{ $item->id_candidato }}','#vTotal{{ $item->id_candidato }}')"required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="vTotal{{ $item->id_candidato }}">Total de votos {{ $item->candidato }}
                                </label>
                                <input type="text" class="form-control soloNumeros"
                                    name="vTotal{{ $item->id_candidato }} " id="vTotal{{ $item->id_candidato }}"
                                    value="0" disabled>

                                <input type="hidden" name="idcandidato{{ $item->id_candidato }}"
                                    value="{{ $item->id_candidato }}">
                            </div>

                        </div>
                    @endforeach



                </div>

                <button type="submit" class="btn btn-primary  btn-lg btn-block"><i class="fas fa-vote-yea"></i> Guardar
                    Conteo de JRV</button>

        </form>


    </div>
@endsection

@section('jsmas')
    <script type="text/javascript" src="{{ asset('assets/js/filt.js') }}"></script>
@endsection
