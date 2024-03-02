@extends('layouts.master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contenedor')
    <div class="container-fluid">

        <h1 class="text-center">Formulario de ingreso de actas</h1>
        <hr>
        <form action="{{ route('guardar2') }}" id="formulario" method="POST">
            @csrf
            <div class="row">

                <div class="col-md-5">

                    <div class="form-group">
                        {{-- centro de votación --}}
                        <label for="centro">Centro de votación</label>

                        <select name="centro" id="centro" class="form-control">
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



                </div>
                <div class="col-md-3">
                    <div class="file-field">
                        <div class="z-depth-1-half mb-4 text-center">
                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp" class="img-fluid"
                                id="selectedImage" name='selectedImage' alt="example placeholder">
                        </div>
                        <div class="d-flex justify-content-center ">
                            <div class="btn btn-mdb-color btn-rounded float-left">
                                <span class="font-weight-bold"><i class="fas fa-file-upload"></i> Subir imagen de
                                    acta...</span>
                                <input type="file" onchange="displaySelectedImage(event, 'selectedImage')">
                            </div>
                            <div class="btn btn-blue btn-rounded float-right">
                                <span class="font-weight-bold"><i class="fas fa-camera"></i> Tomar fotografía de
                                    acta...</span>
                                <input type="file" onchange="displaySelectedImage(event, 'selectedImage')">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-3">
                    <video id="videoStream" autoplay>

                    </video>
                    <div class="file-field">
                        <div class="d-flex justify-content-center ">

                            <div class="btn btn-blue btn-rounded float-right">
                                <span class="font-weight-bold"><i class="fas fa-camera"></i> Tomar fotografía de
                                    acta...</span>
                                <input type="file" onchange="displaySelectedImage(event, 'selectedImage')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary  btn-lg btn-block"><i class="fas fa-vote-yea"></i> Guardar
                Conteo de JRV</button>

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
