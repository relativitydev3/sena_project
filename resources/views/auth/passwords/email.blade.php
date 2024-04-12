@extends('layouts.auth_app')
@section('title')
    email
@endsection
@section('content')


    <head>
        <style>
            /* Estilos para el contenedor de la animación de carga */
            #loader-wrapper {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #f3f3f3;
                z-index: 9999;
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            /* Estilos para la animación de carga */
            #loader {
                border: 4px solid #3498db;
                border-top: 4px solid #f3f3f3;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 2s linear infinite; /* Animación giratoria */
            }
    
            /* Animación giratoria */
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .custom-btn {
    background-color: rgb(116, 204, 58);
    /* Otros estilos que desees aplicar */
}

        </style>
    </head>


<body>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    
    
<br>

<div class="container" style="padding-top: 60px;">
    <div class="card card-primary mx-auto" style="max-width: 400px;">
        <div class="card-header"><h4>Recuperar Contraseña</h4></div>

        <div class="card-body">
            @if (session('status'))
    <div class="alert alert-success">
        {{ trans('auth.sent') }}
        
    </div>
@endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" tabindex="1" value="{{ old('email') }}" autofocus required>
                           @error('email')

                    <div class="invalid-feedback">
                        {{ trans('auth.email') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4" style="background-color: rgb(173, 187, 50)">Enviar</button>
                </div>
            </form>
            <div class="mt-5 text-muted text-center">
                ¿Recordaste tus datos de inicio de sesión? <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>
        </div>
    </div>
    
</div>
    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader-wrapper');
            loader.style.display = 'none';
        });
    </script>
    <!-- Aquí podrías agregar cualquier script necesario -->
</body>

@endsection