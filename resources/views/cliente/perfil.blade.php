@extends('layouts.auth_app')
@section('title')
    Perfil
@endsection
@section('content')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@if (Session::has('sweet-alert'))
    <script>
        Swal.fire({
            icon: '{{ Session::get("sweet-alert.type") }}',
            title: '{{ Session::get("sweet-alert.title") }}',
            text: '{{ Session::get("sweet-alert.text") }}',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif
<div class="container mb-5" style="padding-top: 80px;">
    <!-- Mensajes -->
    <h2 class="text-center">Actualizar mis datos</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('changeperfil') }}" method="POST" class="needs-validation" novalidate>
            
                @csrf
    
                <div class="row mb-3">
                    <div class="form-group mt-3 col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" value="{{ Auth::user()->apellidos }}" class="form-control @error('apellidos') is-invalid @enderror">
                        @error('apellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="form-group mt-3 col-md-6">
                        <label for="documento">Documento</label>
                        <input type="text" name="documento" value="{{ Auth::user()->documento }}" class="form-control" readonly>
                        <small class="form-text text-muted">Para editar el documento contactate con los administradores.</small>
                    </div>
                    
                    <div class="form-group mt-3 col-md-6">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" value="{{ Auth::user()->telefono }}" class="form-control @error('telefono') is-invalid @enderror">
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="form-group mt-3 col-md-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" value="{{ Auth::user()->direccion }}" class="form-control @error('direccion') is-invalid @enderror">
                        @error('direccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 col-md-6">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row text-center mb-4 mt-5">
                    <div class="col-md-12">
                        <button type="submit" style="background-color: rgb(173, 187, 50); color: rgb(255, 255, 255);" class="btn" id="formSubmit">Guardar Cambios</button>

                        <a href="/home" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>





@endsection