@extends('layouts.auth_app')
@section('title')
Inicio
@endsection
@section('content')

<head>
    <style>
        body {
            overflow-x: hidden;
        }

        .no-horizontal-scroll {
            overflow-x: hidden;
        }

        .datos {
            display: flex;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .map-container iframe {
            top: 0;
            left: 1;
            width: 100%;
            height: 450px;
            /* Ajusta la altura según tus preferencias */
        }

        .fixed-size-image {
            width: 200px;
            /* Establece el ancho deseado */
            height: 200px;
            /* Establece la altura deseada */
            object-fit: cover;
            /* Ajusta la imagen para que cubra completamente el área designada */
        }

        .gallery {
            max-width: 83%;
            margin: 5% auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-sizing: border-box;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4);
        }

        .text-center {
            text-align: center;
            margin-bottom: 1em;
        }

        .lightbox-gallery {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }

        .lightbox-gallery div>img {
            max-width: 100%;
            display: block;
            border-radius: .8em;

        }

        .lightbox-gallery div {
            margin: 10px;
            flex-basis: 180px;
        }

        .lightbox-gallery img:hover {
            transform: scale(1.1);
            /* Aumenta el tamaño en un 5% */
            transition: transform 0.3s ease;
            /* Agrega una transición suave */
            border-radius: .5em;
        }


        @media only screen and (max-width: 480px) {
            .lightbox-gallery {
                flex-direction: column;
                align-items: center;
            }

            .lightbox>div {
                margin-bottom: 10px;
            }
        }

        /*Lighbox CSS*/

        .lightbox {
            display: none;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 6em;
            left: 0;
            z-index: 20;
            padding-top: 30px;
            box-sizing: border-box;
        }

        .lightbox img {

            max-width: 70%;
            height: 70%;
            display: block;
            margin: auto;
        }

        .lightbox .caption {
            margin: 15px auto;
            width: 50%;
            text-align: center;
            font-size: 1em;
            line-height: 1.5;
            font-weight: 700;
            color: #eee;
        }
    </style>
</head>


<body class="no-horizontal-scroll">
    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            @foreach ($productos as $producto)
            @if ($producto->activo == 1)
            <li class="text-center">
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Bienvenido a <br> Tropical Detox</strong></h1>
                            <p class="m-b-40">¡Disfrute de una pagina de jugos <br> de todo tipo de sabores
                                junto con personalizados!</p>
                            <p><a class="btn hvr-hover" href="{{ route('Productos') }}">Productos</a></p>
                        </div>
                    </div>
                </div>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container ">
            <div class="row" style="display: flex; justify-content: center !important;align-content: center !important">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-all text-center">
                            <h1>Categorías</h1>
                            <p>Descubre una amplia variedad de jugos frescos y deliciosos en nuestras categorías.
                                Desde jugos cítricos y refrescantes, hasta mezclas exóticas y nutritivas,
                                encontrarás opciones para satisfacer todos los gustos y necesidades.</p>
                        </div>
                    </div>
                </div>
                @foreach ($categorias as $categoria)
                @if ($categoria->activo && $categoria->nombre != 'Personalizados')
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        @if ($categoria->imagen)
                        <img src="{{ asset($categoria->imagen) }}" style="width:25em !important;height:20em !important" alt="Imagen de la categoría" />
                        @else
                        <img class="img-fluid" style="width:25em !important;height:20em !important" src="images/logo.png" alt="Imagen por defecto" />
                        @endif
                        <a class="btn hvr-hover" href="{{ route('Productos') }}">{{ $categoria->nombre }}</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Productos & Categorías</h1>
                        <p>Descubre nuestra amplia selección de jugos frescos y deliciosos,
                            junto con una variedad de categorías que se adaptan a tus preferencias.
                            Disfruta de sabores únicos y opciones personalizadas para satisfacer tu sed de jugos
                            naturales y saludables.
                            ¡Explora nuestras categorías y encuentra tu jugo favorito!.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="" data-filter="*">Todos</button>
                            <button class="" data-toggle="modal" data-target="#Personalizados">Personalizado</button>
                            @foreach ($categorias as $categoria)
                            @if ($categoria->nombre != 'Personalizados')
                            <button data-filter=".{{ $categoria->id }}">{{ $categoria->nombre }}</button>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center special-list">
                @foreach ($productos as $producto)
                @if ($producto->activo == 1 && $producto->categorias_id )
                <div class="col-lg-3 col-md-6 col-sm-6 special-grid {{ $producto->categorias_id }}">
                    <!-- Cartas -->
                    <div class="products-single fix ">
                        <div class="box-img-hover">
                            <!-- Imagen del producto -->
                            <img src="{{ asset($producto->imagen) }}" style="width:25em !important;height:15em !important" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <a class="cart" href="#" data-producto-id="{{ $producto->id }}" data-producto-nombre="{{ $producto->nombre }}" data-producto-precio="{{ $producto->precio }}" onclick="agregarAlCarrito(event);actualizarTotalCarrito(true)">
                                    Agregar al carrito
                                </a>
                            </div>
                        </div>
                        <div class="why-text">
                            <!-- Nombre del producto -->
                            <h4>{{ $producto->nombre }}</h4>
                            <!-- Precio del producto -->
                            <h5>{{ $producto->precio }}</h5>
                            <!-- Descripción del producto -->
                            <p>{{ $producto->descripcion }}</p>
                        </div>

                    </div>
                    <!-- End Cartas -->
                </div>
                @endif
                @endforeach
            </div>

        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Products Personalizados -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>¡Crea el jugo de tus sueños hoy mismo!</h1>
                        <p>Personaliza tu experiencia con nuestros jugos personalizados.
                            ¡Tú eres el chef! Elige tus ingredientes y saborea la innovación en cada sorbo.
                            Tu jugo perfecto está a solo un clic de distancia. ¡Hazlo único, hazlo tuyo!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-toggle="modal" data-target="#Personalizados">Personalizado</button>
                        </div>
                    </div>
                </div>

                <!-- Modal Personalizados-->
                <div class="modal fade my-modal" id="Personalizados" tabindex="-1" role="dialog" aria-labelledby="Personalizados" aria-hidden="true" style="position: absolute; z-index: 1050;right: 10em;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="width:70em !important;height: 35em;">

                            <div class="modal-header">
                                <h2 style="" class="modal-title" id="Personalizados">Producto Personalizados</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="text-center">
                                    <h4>Selecciona 3 insumos para crear un producto personalizado.</h4>
                                </div>
                                <div style="display: flex">
                                    <div class="insumos" style="flex: 1; margin-right: 20px; overflow-y: scroll; max-height: 20em;">
                                        <div class="form-group">
                                            <input style="border-top: none; border-right: none; border-left: none;" type="text" class="form-control" id="buscarInsumo" placeholder="Ingresa el nombre del insumo">
                                        </div>

                                        <table class="table">
                                            <tbody>
                                                @foreach ($Insumo as $Insumos)
                                                <tr class="insumo" data-id="{{ $Insumos->id }}">
                                                    @if ($Insumos->activo ==  1)
                                                    <td><img src="{{ asset($Insumos->imagen) }}" alt="Imagen del producto" width="40em"></td>
                                                    <td>{{ $Insumos->id }}</td>
                                                    <td>{{ $Insumos->nombre }}</td>
                                                    <td>${{ $Insumos->precio_unitario }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success agregar-insumo" style="max-width: 1em; max-height: 1.5em;">
                                                            <i class="fas fa-plus fa-xs" style="position: relative; bottom: 8.5px;right: 5px"></i>
                                                        </button>
                                                        {{-- <button type="button"
                                                                    class="btn btn-primary agregar-insumox2"
                                                                    style="max-width: 2.2em; max-height: 1.5em;">
                                                                    <i class="fas fa-times"
                                                                        style="position: relative; bottom: 8.5px;right: 5px">
                                                                        2</i>
                                                                </button> --}}
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="insumos_selecionados" style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 20em;">
                                        <h3>Insumo seleccionados</h3>
                                        <div id="totalInsumosSeleccionados">
                                            Total: $0.00
                                        </div>
                                        <ul class="lista-insumos-seleccionados"></ul>
                                        <!-- Agrega esta tabla en el modal donde deseas mostrar los insumos seleccionados -->
                                        <div class="insumos_selecionados" style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 20em;">
                                            <table class="table tabla-insumos-seleccionados">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Cantida</th>
                                                        <th>Precio</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Los insumos seleccionados se agregarán aquí dinámicamente -->
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;align-items: center ;justify-content: center;padding: 0em; position: relative;bottom: 1.5em;">

                                <div class="form-group" style="margin: 0em;padding: 0em;width: 75%;;position: relative;bottom: 1em">
                                    <label for="descripcion">Descripción:</label>
                                    <textarea class="form-control" maxlength="200" style="width: 100%; height: 3em !important; resize: none; position: relative; right: 1em !important;" id="descripcion"></textarea>
                                </div>


                                <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                                <div class="modal-footer" style="margin: 0em;padding: 0em;">
                                    <button type="button" style="background-color: rgb(173, 187, 50); color: rgb(255, 255, 255);" class="btn" id="crearPersonalizados" data-dismiss="modal" onclick=" mostrarAlertaExitosa('Producto agregado al carrito exitosamente');actualizarTotalCarrito()">
                                        Crear
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Obtener referencia al campo de búsqueda
                        const inputBuscarInsumo = document.getElementById('buscarInsumo');

                        // Obtener todas las filas de insumos para poder mostrar/ocultar según el filtro
                        const insumosFila = document.querySelectorAll('.insumos .insumo');

                        // Agregar evento de input para el campo de búsqueda
                        inputBuscarInsumo.addEventListener('input', function() {
                            const terminoBusqueda = inputBuscarInsumo.value.trim().toLowerCase();

                            // Mostrar solo los insumos que coinciden con el término de búsqueda
                            insumosFila.forEach(function(filaInsumo) {
                                const textoInsumo = filaInsumo.querySelector('td:nth-child(3)').textContent
                                    .toLowerCase();
                                if (textoInsumo.includes(terminoBusqueda)) {
                                    filaInsumo.style.display = 'table-row';
                                } else {
                                    filaInsumo.style.display = 'none';
                                }
                            });
                        });
                    });
                </script>
                <!-- Modal Personalizados-->
            </div>

        </div>
    </div>
    <!-- End Products Personalizados -->

    <!-- Mapas -->
    <section class="">
        {{-- <div class="col-lg">
                <div class="title-all text-center">
                    <h1>Nuestra ubicación</h1>
                    <p class="text-center">Estamos ubicados en el corazón de la ciudad, </p>
                    <p>Nuestra tienda ofrece una amplia gama de productos y servicios para satisfacer todas tus
                        necesidades. Ven a visitarnos y descubre todo lo que tenemos para ofrecerte.</p>
                </div>
            </div> --}}
        <div class="col-md-10 offset-md-1" style="box-shadow: 0px 0px 10px rgb(0, 0, 0.5);border-radius:1em;
                margin-bottom: 2em ">
            <div class="col-lg">
                <div class="title-all text-center" style="position: relative;top: .5em">
                    <h1>Nuestra ubicación</h1>
                </div>
            </div>
            <div class="datos">
                <div class="map-container" style="border-radius:.5em;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.091014502089!2d-75.57329091929331!3d6.251737682916861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428f87e3a6a1b%3A0xb896939f7c66ce69!2sCra.%2046%20%2350-13%2C%20La%20Candelaria%2C%20Medell%C3%ADn%2C%20La%20Candelaria%2C%20Medell%C3%ADn%2C%20Antioquia!5e0!3m2!1ses-419!2sco!4v1693095037647!5m2!1ses-419!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div style="margin-bottom: 2em; ">
                <p class="text-center">Estamos ubicados en el corazón de la ciudad, </p>
                <p>Nuestra tienda ofrece una amplia gama de productos y servicios para satisfacer todas tus
                    necesidades. Ven a visitarnos y descubre todo lo que tenemos para ofrecerte.</p>
            </div>
        </div>
    </section>
    <!-- End mapas -->

    <div class="gallery">
        <h2 class="text-center">Galeria</h2>
        <div class="lightbox-gallery">
            <div><img src="img/IMGWelcome/JugoDurazno.png" data-image-hd="img/IMGWelcome/JugoDurazno.png" alt="El jugo de durazno es una deliciosa opción que combina la dulzura natural de los duraznos con un toque refrescante.">
            </div>
            <div><img src="img/IMGWelcome/JugoKiwi.png" data-image-hd="img/IMGWelcome/JugoKiwi.png" alt="El jugo de kiwi es conocido por su vibrante color verde y su sabor ligeramente ácido y refrescante.">
            </div>
            <div><img src="img/IMGWelcome/JugoManzana.png" data-image-hd="img/IMGWelcome/JugoManzana.png" alt="El jugo de manzana es un clásico reconfortante, con su dulzura natural en cada sorbo.">
            </div>
            <div><img src="img/IMGWelcome/JugoMaracuya.png" data-image-hd="img/IMGWelcome/JugoMaracuya.png" alt="El jugo de maracuyá ofrece un sabor tropical y exótico con una deliciosa mezcla de dulzura y acidez.">
            </div>
            <div><img src="img/IMGWelcome/JugoPapaya.png" data-image-hd="img/IMGWelcome/JugoPapaya.png" alt="El jugo de papaya es suave y cremoso, lleno de nutrientes y frescura.">
            </div>
            <div><img src="img/IMGWelcome/JugoPera.png" data-image-hd="img/IMGWelcome/JugoPera.png" alt="El jugo de pera captura la dulzura y el aroma delicado de esta fruta en un refrescante sorbo.">
            </div>
            <div><img src="img/IMGWelcome/JugoPiña.png" data-image-hd="img/IMGWelcome/JugoPiña.png" alt="El jugo de piña es una explosión tropical, combinando dulzura y acidez en una bebida revitalizante.">
            </div>
            <div><img src="img/IMGWelcome/JugoUva.png" data-image-hd="img/IMGWelcome/JugoUva.png" alt="El jugo de uva es energizante y lleno de sabor, con su dulzura natural lista para disfrutar.">
            </div>
        </div>
    </div>


    </div>

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>


    <div style="margin-top: 10%">

    </div>
    {{-- Scrip de la galeria --}}
    <script>
        // Create a lightbox
        (function() {
            var $lightbox = $("<div class='lightbox'></div>");
            var $img = $("<img>");
            var $caption = $("<p class='caption'></p>");

            // Add image and caption to lightbox
            $lightbox
                .append($img)
                .append($caption);

            // Add lightbox to document
            $('body').append($lightbox);

            $('.lightbox-gallery img').click(function(e) {
                e.preventDefault();

                // Get image link and description
                var src = $(this).attr("data-image-hd");
                var cap = $(this).attr("alt");

                // Add data to lightbox

                $img.attr('src', src);
                $caption.text(cap);

                // Show lightbox

                $lightbox.fadeIn('fast');

                $lightbox.click(function() {
                    $lightbox.fadeOut('fast');
                });
            });

        })();
    </script>
    <script>
        function agregarAlCarrito(event) {
            event.preventDefault();

            // Obtener el carrito del Local Storage
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Obtener los datos del producto del enlace
            let productoId = event.target.dataset.productoId;
            let nombreS = event.target.dataset.productoNombre;
            let precioS = event.target.dataset.productoPrecio;

            // Buscar el producto en el carrito
            let productoEnCarrito = carrito.find(item => item.id === productoId);

            if (productoEnCarrito) {
                // Si el producto ya existe en el carrito, actualizar la cantidad
                productoEnCarrito.cantidad += 1;
            } else {
                // Si el producto no existe en el carrito, agregarlo
                let producto = {
                    id: productoId,
                    nombre: nombreS,
                    precio: precioS,
                    cantidad: 1
                };

                carrito.push(producto);
            }

            // Guardar el carrito actualizado en el Local Storage
            localStorage.setItem('carrito', JSON.stringify(carrito));


            // Ejemplo de uso:
            mostrarAlertaExitosa('Producto agregado al carrito exitosamente');
        }
        // Mostrar un mensaje de éxito o redirigir al usuario si deseas
        function mostrarAlertaExitosa(mensaje) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: mensaje,
                timer: 3000, // Tiempo en milisegundos (3 segundos en este caso)
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-show-custom', // Clase personalizada para el estilo
                }
            });
        }

        function nosepuedeAgregar(mensaje) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: mensaje,
                timer: 3000, // Tiempo en milisegundos (3 segundos en este caso)
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                background: '#f2dede', // Color de fondo de la alerta (estilo de error)
                color: '#a94442',
                customClass: {
                    icon: 'swal2-error-icon-custom', // Clase personalizada para el estilo
                }
            });
        }

        $(document).ready(function() {
            $('#Personalizados').on('hidden.bs.modal', function() {
                $('#descripcion').val('');
            });

            var maxSeleccionados = 3;
            var insumosSeleccionadosSet = new Set();
            var numeroPersonalizado = 1;
            var insumosCantidad = {}; // Objeto para almacenar la cantidad de insumos iguales



            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
            if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                var ultimoNumeroPersonalizado = productosPersonalizadosGuardados[productosPersonalizadosGuardados
                    .length - 1].NumeroPersonalizado;
                numeroPersonalizado = ultimoNumeroPersonalizado + 1;
            }
            // nosepuedeAgregar
            $(document).on('click', '.agregar-insumo', function() {
                let insumoNombre = $(this).closest('tr').find('td:nth-child(3)').text();
                let insumoId = $(this).closest('tr').data('id');
                let insumoPrecio = parseFloat($(this).closest('tr').find('td:nth-child(4)').text().match(
                    /\d+/)[0]);

                let cantidadTotal = Object.values(insumosCantidad).reduce((total, cantidad) => total +
                    cantidad, 0);

                if ($('.tabla-insumos-seleccionados tbody tr').length >= maxSeleccionados ||
                    cantidadTotal >= maxSeleccionados) {
                    nosepuedeAgregar('No puedes agregar más insumos o la cantidad total ya es 3.');
                    return;
                }

                if (insumosSeleccionadosSet.has(insumoId)) {
                    insumosCantidad[insumoId]++;
                    let insumoFila = $(`.tabla-insumos-seleccionados tbody tr[data-id="${insumoId}"]`);
                    insumoFila.find('td:nth-child(3)').text(insumosCantidad[insumoId]);
                } else {
                    insumosSeleccionadosSet.add(insumoId);
                    insumosCantidad[insumoId] = 1;

                    var newRow = $('<tr>').attr('data-id', insumoId);
                    newRow.append($('<td>').text(insumoId));
                    newRow.append($('<td>').text(insumoNombre));
                    newRow.append($('<td>').text(insumosCantidad[insumoId]));
                    newRow.append($('<td>').text(`$${insumoPrecio}`));

                    var removeButton = $('<button>').addClass('btn btn-danger quitar-insumo');
                    var removeIcon = $('<i>').addClass('fas fa-trash');
                    removeButton.append(removeIcon);
                    newRow.append($('<td>').append(removeButton));


                    $('.tabla-insumos-seleccionados tbody').append(newRow);
                }

                recalcularTotalInsumosSeleccionados();
            });
            $(document).on('click', '.agregar-insumox2', function() {
                let insumoNombre = $(this).closest('tr').find('td:nth-child(3)').text();
                let insumoId = $(this).closest('tr').data('id');
                let insumoPrecio = parseFloat($(this).closest('tr').find('td:nth-child(4)').text().match(
                    /\d+/)[0]);

                let cantidadTotal = Object.values(insumosCantidad).reduce((total, cantidad) => total +
                    cantidad, 0);

                let cantidadInsumo = insumosCantidad[insumoId] || 0;

                let existeInsumoConCantidadDosOMas = Object.values(insumosCantidad).some(cantidad =>
                    cantidad >= 2);

                if (cantidadTotal >= maxSeleccionados || cantidadInsumo >= 2 ||
                    existeInsumoConCantidadDosOMas) {
                    nosepuedeAgregar(
                        'No puedes agregar más insumos o ya has agregado un insumo con cantidad x2.');
                    return;
                }

                if (insumosSeleccionadosSet.has(insumoId)) {
                    insumosCantidad[insumoId]++;
                    let insumoFila = $(`.tabla-insumos-seleccionados tbody tr[data-id="${insumoId}"]`);
                    insumoFila.find('td:nth-child(3)').text(insumosCantidad[insumoId]);
                } else {
                    insumosSeleccionadosSet.add(insumoId);
                    insumosCantidad[insumoId] = 1;

                    var newRow = $('<tr>').attr('data-id', insumoId);
                    newRow.append($('<td>').text(insumoId));
                    newRow.append($('<td>').text(insumoNombre));
                    newRow.append($('<td>').text(insumosCantidad[insumoId] * 2));
                    newRow.append($('<td>').text(`$${insumoPrecio}`));

                    var removeButton = $('<button>').addClass('btn btn-danger quitar-insumo');
                    var removeIcon = $('<i>').addClass('fas fa-trash');
                    removeButton.append(removeIcon);
                    newRow.append($('<td>').append(removeButton));


                    $('.tabla-insumos-seleccionados tbody').append(newRow);
                }

                recalcularTotalInsumosSeleccionados();
            });
            $(document).on('click', '.quitar-insumo', function() {
                var insumoId = $(this).closest('tr').data('id');

                if (insumosSeleccionadosSet.has(insumoId)) {
                    var insumoFila = $(`.tabla-insumos-seleccionados tbody tr[data-id="${insumoId}"]`);
                    var cantidadActual = parseInt(insumoFila.find('td:nth-child(3)').text());

                    if (cantidadActual > 1) {
                        insumosCantidad[insumoId]--;
                        insumoFila.find('td:nth-child(3)').text(cantidadActual - 1);
                    } else {
                        insumosSeleccionadosSet.delete(insumoId);
                        delete insumosCantidad[insumoId];
                        insumoFila.remove();
                    }

                    recalcularTotalInsumosSeleccionados();
                }
            });
            $('#crearPersonalizados').click(function() {
                var insumosSeleccionados = $('.tabla-insumos-seleccionados tbody tr');

                var cantidadTotalInsumos = Object.values(insumosCantidad).reduce((total, cantidad) =>
                    total + cantidad, 0);

                if (insumosSeleccionados.length < 3 && cantidadTotalInsumos < 3) {
                    nosepuedeAgregar(
                        'Debes seleccionar 3  insumo para crear un producto personalizado.');
                    return; // Salir de la función si no hay insumos seleccionados
                }

                actualizarTotalCarrito(true);
                // Obtener la descripción del campo de entrada de texto
                var descripcion = $('#descripcion').val();
                var personalizado = {
                    NumeroPersonalizado: numeroPersonalizado,
                    Nombre: `Personalizado ${numeroPersonalizado}`,
                    Subtotal: 0,
                    Cantidad: 1,
                    Descripcion: descripcion || 'Sin descripción',

                    insumos: []
                };

                insumosSeleccionados.each(function() {
                    var insumoId = $(this).data('id');
                    var insumoNombre = $(this).find('td:nth-child(2)').text();
                    var insumoPrecio = parseFloat($(this).find('td:nth-child(4)').text().match(
                        /\$(\d+(\.\d{1,2})?)/)[1]);

                    var insumoDetalles =
                        `${insumoId} : ${insumoNombre} $: ${insumoPrecio} (cantidad: ${insumosCantidad[insumoId]})`;
                    personalizado.insumos.push(insumoDetalles);
                    personalizado.Subtotal += insumoPrecio * insumosCantidad[insumoId];
                });

                numeroPersonalizado++;

                var productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) || [];
                productosPersonalizados.push(personalizado);
                localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizados));

                insumosSeleccionadosSet.clear();
                insumosCantidad = {}; // Limpiar el objeto de cantidad de insumos iguales
                $('.tabla-insumos-seleccionados tbody').empty();
                $('#descripcion').val(''); // Borrar el contenido del textarea después de crear
            });

            // Función para recalcular el total de insumos seleccionados
            function recalcularTotalInsumosSeleccionados() {
                var total = 0;
                $('.tabla-insumos-seleccionados tbody tr').each(function() {
                    var insumoPrecioSeleccionado = parseFloat($(this).find('td:nth-child(4)').text().match(
                        /\d+(\.\d{1,2})?/)[0]);
                    var cantidad = insumosCantidad[$(this).data('id')];

                    // Multiplicar el precio por 2 si es un insumo agregado con el botón "agregar-insumox2"
                    // Multiplicar el precio por 2 si es un insumo agregado con el botón "agregar-insumox2"
                    total += insumoPrecioSeleccionado * cantidad;
                });

                let formattedTotal = total.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                $('#totalInsumosSeleccionados').text(`Total: ${formattedTotal}`);
            }

            function recalcularTotalInsumosSeleccionados1() {
                var total = 0;
                $('.tabla-insumos-seleccionados tbody tr').each(function() {
                    var insumoPrecioSeleccionado = parseFloat($(this).find('td:nth-child(4)').text().match(
                        /\d+(\.\d{1,2})?/)[0]);
                    var cantidad = insumosCantidad[$(this).data('id')];

                    // Multiplicar el precio por 2 si es un insumo agregado con el botón "agregar-insumox2"
                    // Multiplicar el precio por 2 si es un insumo agregado con el botón "agregar-insumox2"
                    total += insumoPrecioSeleccionado * cantidad * 2;
                });

                let formattedTotal = total.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                $('#totalInsumosSeleccionados').text(`Total: ${formattedTotal}`);
            }
        });
    </script>

</body>
@endsection