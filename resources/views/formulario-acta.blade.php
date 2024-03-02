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
        <div class="row">
            <div class="col-12 col-lg-6">
                @include('partials.informacion-acta', compact('datos'))
            </div>
            <div class="col-12 col-lg-6">
                <form class="my-3" action="{{ route('acta.procesar') }}" id="formulario" method="POST" enctype="multipart/form-data">
                    @csrf
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
                    <button type="submit" class="btn btn-info w-100 mt-3">
                        <i class="fas fa-file-upload mr-1"></i>
                        Subir imagen
                    </button>
                </form>
            </div>
        </div>
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
