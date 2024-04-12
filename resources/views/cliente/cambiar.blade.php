@extends('layouts.auth_app')
@section('title')
    Cambiar contraseña
@endsection
@section('content')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error de validación',
            text: 'Verifica los errores, La contraseña debe tener minimo 6 digitos.',
        });
    </script>
@endif
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
    <!--- Mensajes -->
    
    <h2 class="text-center">Cambiar contraseña <hr></h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('changePassword2') }}" method="POST" class="needs-validation" novalidate>
                @csrf 
    
                <div class="form-group mt-3 text-center">
                    <label for="password_actual">Clave Actual</label>
                    <div class="input-group">
                        <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" id="toggle-password-actual">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    @error('password_actual')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3 text-center">
                    <label for="new_password">Nueva Clave</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" id="toggle-password-actual">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3 text-center">
                    <label for="confirm_password">Confirmar nueva Clave</label>
                    <div class="input-group">
                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" id="toggle-password-actual">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    $(document).ready(function () {
                        $(".toggle-password").click(function () {
                            $(this).toggleClass("active");
                            var input = $(this).closest(".input-group").find("input");
                            var icon = $(this).find("i");
                
                            if (input.attr("type") === "password") {
                                input.attr("type", "text");
                                icon.removeClass("fa-eye").addClass("fa-eye-slash");
                            } else {
                                input.attr("type", "password");
                                icon.removeClass("fa-eye-slash").addClass("fa-eye");
                            }
                        });
                    });
                </script>
                
    
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');
        
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                return;
            }
            
            event.preventDefault();
            
            Swal.fire({
                title: 'Cambio de contraseña exitoso',
                text: 'La contraseña se ha cambiado correctamente.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/home';
                }
            });
        });
    });
</script>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

@endsection