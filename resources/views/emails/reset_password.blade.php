<!DOCTYPE html>
<html>
<head>
    <!-- Agrega enlaces a estilos en línea de Bootstrap 5 aquí -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .text-center {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <img src="{{ asset('img/logo.png') }}" alt="Imagen" style="max-width: 100px;">
        </div>
        <h1 class="text-center">¡Hola!</h1>
        <p>Hemos recibido una notificación para el reinicio de contraseña.</p>
        <p>Esperamos poder ayudarte con el proceso de restablecimiento de contraseña.</p>
        <p class="text-center">
            <a href="{{ url('/password/reset/'.$token) }}" class="btn">Reiniciar Contraseña</a>
        </p>
        <p>Si no solicitaste el reinicio de contraseña, no es necesario realizar ninguna acción.</p>
        <p>Gracias por confiar en nosotros.</p>
    </div>
</body>
</html>
