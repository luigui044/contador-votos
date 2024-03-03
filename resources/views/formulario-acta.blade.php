@extends('layouts.master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('contenedor')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="my-3 text-center">Formulario de ingreso de actas</h1>
        </div>
        <hr>
        <form class="my-3" action="{{ route('acta.procesar') }}" id="frm-acta" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        {{-- centro de votación --}}
                        <label for="centro">Centro de votación</label>

                        <select name="centro" id="centro" class="form-control">
                            <option value="">Seleccione centro de votación:</option>
                            @foreach ($centros as $item)
                                <option value="{{ $item->id_centro }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Número JRBV --}}
                    <div class="form-group" id="filtrar">
                        <label for="jrv">Número de JRV:</label>
                        <select name="jrv" id="jrv" class="form-control" disabled>
                            <option value="">Seleccione número de JRV</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">
                        <i class="fas fa-vote-yea"></i>
                        Procesar Acta
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="file-field">
                        <div class="z-depth-1-half mb-4 text-center">
                            <img src="{{ $urlArchivo ?? 'https://mdbootstrap.com/img/Photos/Others/placeholder.webp' }}"
                                class="img-fluid" id="selectedImage" name='selectedImage' alt="example placeholder">
                        </div>
                        <div class="d-flex justify-content-center ">
                            <div class="btn btn-mdb-color btn-rounded float-left">
                                <span class="font-weight-bold">
                                    <i class="fas fa-image mr-1"></i>
                                    Seleccionar imagen del acta ...
                                </span>
                                <input type="file" onchange="displaySelectedImage(event, 'selectedImage')"
                                    name="archivo_acta">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('jsmas')
    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/filt2.js') }}"></script>
@endsection
