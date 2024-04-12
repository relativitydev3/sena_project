<!DOCTYPE html>
<html lang="en">



<head>
<style>
    html, body {
  height: 82%;

}

/* Contenedor del contenido principal */
.content-wrapper {
  min-height: 100%; /* Ocupará al menos toda la altura de la ventana */
  margin-bottom: -60px; /* Altura del footer (ajusta según tu diseño) */
}

/* Footer */
.footer {

  position: relative;
  bottom: 0;
  width: 100%;
  height: 60px; /* Altura del footer */
}
</style>

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>



    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="public/images/logo.png" type="image/png">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Agrega Font Awesome en el head de tu documento HTML -->






</head>



<body>
@include('cliente.nav')

<div class="content-wrapper">
    @yield('content')
</div>



<footer class="footer">
    @include('cliente.footer')
  </footer>






    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.superslides.min.js"></script>



    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- <script src="js/bootsnav.js."></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script src="/js/jquery-3.2.1.min.js"></script>
    {{-- <script src="/js/popper.min.js"></script> --}}

    <!-- ALL PLUGINS -->

</body>

</html>