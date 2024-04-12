@extends('layouts.auth_app')
@section('title')
    Carrito
@endsection
@section('content')

    <body>

        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row" style="padding-top: 60px;">
                <div class="col-lg-12">
                    <div class="title-all text-center">

                        <h1>Carrito de Productos</h1>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="carritoTabla" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="carrito-body">
                                <!-- Filas de productos en el carrito -->
                            </tbody>

                            <tbody class="carrito-body-personalizado">
                                <!-- Filas de productos en el carrito -->
                            </tbody>
                            <tr>

                                <th colspan="3">
                                    Total del Pedido:
                                </th>
                                <th style="padding: 0em;padding-left: 0.5em;width: 100px">
                                    <span id="totalPedido">0.00</span>
                                </th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            @if (empty(\Illuminate\Support\Facades\Auth::user()->name))
                <button type="submit" class="btn third" onclick="mostrarAlerta()">Guardar Pedido</button>
            @else
                <form id="formulario-guadar-pedido" action="{{ route('guardarPedido') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Direcion">Si vas a colocar otra dirección ponlo aquí:</label>
                        <input type="text" name="Direcion" id="Direcion" class="form-control"
                            value="{{ \Illuminate\Support\Facades\Auth::user()->direccion }}">
                    </div>
                    <div class="form-group">
                        <label for="Descripcion">Descripción:</label>
                        <input type="text" name="Descripcion" id="Descripcion" class="form-control">
                    </div>
                    <Script>
                        let direccionInput = document.getElementById('Direcion');

                        // Add event listener for 'blur' event to trim the input value
                        direccionInput.addEventListener('blur', function() {
                            direccionInput.value = direccionInput.value.trim();
                        });
                    </Script>
                    <input type="hidden" name="carrito" id="carrito" value="">
                    <input type="hidden" name="productosPersonalizados" id="productosPersonalizados" value="">
                    <button type="submit" class="btn third">Guardar Pedido</button>
                </form>
            @endif
        </div>
        @if (session('script'))
            {!! session('script') !!}
        @endif
        <!-- Modal -->
        <div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detallesModalLabel">Detalles del Producto Personalizado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                        <p><strong>Insumo:</strong> <span id="modalInsumo"></span></p>
                        <p style="word-wrap: break-word;"><strong>Descripción:</strong> <span id="modalDescripcion"></span>
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     

        <script>
            $(document).on('click', '.btn-ver-detalles', function() {
                var index = $(this).closest('tr').find('input[type="number"]').data('index');
                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                var productoPersonalizado = productosPersonalizadosGuardados[index];
                mostrarDetallesModal(productoPersonalizado);
            });
            // Agregar un evento para validar la entrada en todos los campos input[type="number"]
            $(document).on('input', 'input[type="number"]', function() {
                let inputValue = $(this).val();

                // Verificar si el valor es un número válido
                if (!/^[0-9]*$/.test(inputValue)) {
                    $(this).val(''); // Limpiar el valor si contiene caracteres no numéricos
                }

                // Verificar si el valor es menor que 1
                let numericValue = parseInt(inputValue);
                if (isNaN(numericValue) || numericValue < 1) {
                    numericValue = 1; // Restablecer el valor a 1 si es menor que 1 o no es un número
                    $(this).val(numericValue); // Actualizar el valor del input
                }
            });


            function mostrarDetallesModal(productoPersonalizado) {
                $('#detallesModalLabel').text('Detalles del Producto Personalizado');

                // Llenar los detalles en el modal
                $('#modalNombre').text(productoPersonalizado.Nombre);
                $('#modalCantidad').text(productoPersonalizado.Cantidad);
                $('#modalDescripcion').text(productoPersonalizado.Descripcion);

                // Limpiar el contenido anterior de #modalInsumo
                $('#modalInsumo').empty();

                // Iterar a través de los insumos y agregarlos al modal
                for (let index = 0; index < productoPersonalizado.insumos.length; index++) {
                    let insumo = productoPersonalizado.insumos[index];
                    let insumoElement = $('<p>').text(insumo);
                    $('#modalInsumo').append(insumoElement);
                }

                // Mostrar el modal
                $('#detallesModal').modal('show');
            }
        </script>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <script>
            function calcularTotalPedido() {
                let totalPedido = 0;

                // Cálculo del total de productos personalizados
                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                    productosPersonalizadosGuardados.forEach(function(productoPersonalizado) {
                        productoPersonalizado.insumos.forEach(function(insumo) {
                            let insumoData = insumo.split(':');
                            // let insumoSubtotal = parseFloat(insumoData[ insumoData.length - 1]);
                            // alert(cantidad);
                            // Verificar que el valor sea numérico antes de sumarlo al totalPedido
                            if (!isNaN(parseFloat(insumoData[2].trim()))) {
                                let cantidad = parseFloat(insumoData[insumoData.length - 1]);
                                totalPedido += parseFloat(insumoData[2].trim()) * cantidad;
                            }
                        });
                    });
                }

                // Cálculo del total del carrito
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                carrito.forEach(function(producto) {
                    // Verificar que el valor sea numérico antes de sumarlo al totalPedido
                    if (!isNaN(producto.precio)) {
                        totalPedido += parseFloat(producto.precio);
                    }
                });


                return totalPedido; // Asegurarse de que el total tenga solo 2 decimales
            }


            // Evento DOMContentLoaded para cargar la página
            document.addEventListener("DOMContentLoaded", function() {
                // Mostrar los productos personalizados en la tabla
                mostrarProductosPersonalizados();

                // Calcular el total y actualizarlo en el DOM
                actualizarTotalEnDOM();

                // Calcular y actualizar los subtotales en el carrito
                actualizarSubtotalesEnCarrito();
            });

            // alert(calcularTotalPedido());

            // Función para actualizar el total en el DOM
            function actualizarTotalEnDOM() {
                let totalPedido = 0;

                // Cálculo del total de productos personalizados
                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                    productosPersonalizadosGuardados.forEach(function(productoPersonalizado) {
                        let subtotalf = 0;
                        productoPersonalizado.insumos.forEach(function(insumo) {
                            let insumoData = insumo.split(':');
                            let cantidad = parseFloat(insumoData[insumoData.length - 1]);

                            subtotalf += parseFloat(insumoData[2].trim()) * cantidad;
                        });
                        let subtotalPersonalizado = subtotalf * (productoPersonalizado.cantidad || 1);
                        totalPedido += subtotalPersonalizado;
                        productoPersonalizado.subtotal = subtotalPersonalizado;
                    });
                }

                // Cálculo del total del carrito
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                carrito.forEach(function(producto) {
                    // Verificar que el valor sea numérico antes de sumarlo al totalPedido
                    if (!isNaN(producto.precio)) {
                        totalPedido += parseFloat(producto.precio) * producto.cantidad;
                    }
                });

                // Actualizar el total en el DOM
                let totalFormateado = totalPedido.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                // alert(totalFormateado);
                document.getElementById('totalPedido').textContent = totalFormateado;
            }




            function actualizarSubtotalesEnCarrito() {
                let totalPedido = 0;

                // Cálculo del total de productos personalizados
                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                    productosPersonalizadosGuardados.forEach(function(productoPersonalizado) {
                        let subtotalf = 0;
                        productoPersonalizado.insumos.forEach(function(insumo) {
                            let insumoData = insumo.split(':');
                            subtotalf += parseFloat(insumoData[2].trim());
                        });
                        let subtotalPersonalizado = subtotalf * (productoPersonalizado.cantidad || 1);
                        totalPedido += subtotalPersonalizado;
                        productoPersonalizado.subtotal = subtotalPersonalizado;
                    });
                }

                // Cálculo del total del carrito
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                carrito.forEach(function(producto) {
                    // Verificar que el valor sea numérico antes de sumarlo al totalPedido
                    if (!isNaN(producto.subtotal)) {
                        totalPedido += parseFloat(producto.subtotal);
                    }
                });

                // Actualizar los subtotales en el DOM para los productos personalizados
                let carritoPersonalizadoBody = $('.carrito-body-personalizado');
                carritoPersonalizadoBody.find('.subtotal').each(function(index, element) {
                    let subtotalPersonalizado = productosPersonalizadosGuardados[index].subtotal || 0;
                    $(element).text(subtotalPersonalizado);
                });

                // Actualizar el total del carrito en el DOM
                let carritoBody = $('.carrito-body');
                carritoBody.find('.subtotal').each(function(index, element) {
                    let subtotalCarrito = parseFloat($(element).text());
                    carrito[index].subtotal =
                        subtotalCarrito; // Actualizar el subtotal en el objeto del producto en el carrito
                });
                // Actualizar el total en el DOM
                document.getElementById('totalPedido').textContent = totalPedido;
            }




            function mostrarProductosPersonalizados() {
                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                var carritoBody = $('.carrito-body-personalizado');
                carritoBody.empty();

                if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                    productosPersonalizadosGuardados.forEach(function(productoPersonalizado, index) {
                        // Crea una nueva fila en la tabla con los datos del producto personalizado
                        var row = $('<tr>');
                        row.append($('<td>').text(productoPersonalizado.Nombre));

                        let subtotalf = 0;

                        productoPersonalizado.insumos.forEach(function(insumo) {
                            let insumoData = insumo.split(':');
                            let insumoSubtotal = parseFloat(insumoData[2].trim()) * parseFloat(insumoData[
                                insumoData.length - 1]);
                            subtotalf += insumoSubtotal;
                        });

                        row.append($('<td>').text(subtotalf));


                        // Crear el campo de entrada numérico para la cantidad
                        let inputCantidad = $('<input>').attr({
                            type: 'number',
                            min: 1,
                            value: productoPersonalizado.cantidad ||
                                1 // Valor inicial de cantidad, puede ser cualquier valor predeterminado que desees
                        });

                        // Agregar un atributo data-index para identificar el producto personalizado correspondiente
                        inputCantidad.attr('data-index', index);

                        // Agregar un evento para actualizar el subtotal y la cantidad cuando cambie el valor del input
                        inputCantidad.on('input', function() {
                            let cantidad = parseFloat(inputCantidad.val());
                            if (isNaN(cantidad) || cantidad < 1) {
                                cantidad = 1; // Asegurar que la cantidad sea al menos 1
                            }
                            productoPersonalizado.cantidad =
                                cantidad; // Actualizar la cantidad en el objeto del producto

                            // Calcular el nuevo subtotal con la nueva cantidad y actualizarlo en la tabla
                            let subtotal = calcularSubtotalapersonalizado(productoPersonalizado, subtotalf);

                            row.find('.subtotal').text(subtotal.toFixed(
                                0)); // Actualizar el valor del subtotal en la fila

                            // Actualizar el objeto productosPersonalizadosGuardados con la nueva cantidad
                            productosPersonalizadosGuardados[index].cantidad = cantidad;

                            // Actualizar el Local Storage con la nueva cantidad
                            actualizarCantidadEnLocalStorage(productosPersonalizadosGuardados);

                            // Actualizar el atributo value del input type="hidden" con los datos actualizados
                            actualizarHiddenInput();

                            // Actualizar el total del pedido en el DOM
                            actualizarTotalEnDOM();
                        });

                        row.append($('<td>').append(inputCantidad));

                        // Calcular y mostrar el subtotal inicialmente
                        let subtotal = calcularSubtotalapersonalizado(productoPersonalizado, subtotalf);
                        row.append($('<td>').text(subtotal.toFixed(0)).addClass('subtotal'));

                        // Agrega la fila a la tabla
                        carritoBody.append(row);

                        // Agregar botón de eliminar para productos personalizados
                        let columnaAcciones = $('<td>');
                        let botonEliminar = $('<button>').html('<i class="fas fa-trash"></i>').addClass('btn thirdd');


                        // actualizarTotalCarrito()
                        botonEliminar.on('click', function() {
                            eliminarProductoPersonalizado(index);
                            actualizarTotalCarrito();
                        });


                        let botonVerDetalles = $('<button>').html('<i class="fas fa-eye"></i>').addClass(
                            'btn third btn-ver-detalles').css({
                            margin: '4px',

                        });
                        // Agregar el icono al botón utilizando la clase de icono de Bootstrap (por ejemplo, el ícono "eye")




                        botonVerDetalles.attr('data-toggle', 'modal');
                        botonVerDetalles.attr('data-target', '#detallesModal');


                        columnaAcciones.append(botonEliminar);
                        columnaAcciones.append(botonVerDetalles);
                        // Agregar la columna de acciones a la fila
                        row.append(columnaAcciones);
                    });
                }

                // Actualizar el atributo value del input type="hidden" con los datos actuales al cargar la página
                actualizarHiddenInput();

                // Actualizar el total del pedido en el DOM
                actualizarTotalEnDOM();
            }



            function actualizarCantidadEnLocalStorage(productosPersonalizados) {
                localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizados));

                // Calcular y actualizar los subtotales de los productos personalizados en el Local Storage
                productosPersonalizados.forEach(function(productoPersonalizado, index) {
                    let subtotalf = 0;
                    productoPersonalizado.insumos.forEach(function(insumo) {
                        let insumoData = insumo.split(':');
                        subtotalf += parseFloat(insumoData[2].trim());
                    });
                    productoPersonalizado.subtotal = calcularSubtotalapersonalizado(productoPersonalizado, subtotalf);
                });

                // Actualizar el total del pedido en el DOM
                actualizarTotalEnDOM();
            }
            // Función para actualizar el atributo value del input type="hidden" con los datos actualizados
            function actualizarHiddenInput() {
                let productosPersonalizadosHidden = $('#productosPersonalizados');
                let productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                productosPersonalizadosHidden.val(JSON.stringify(productosPersonalizadosGuardados));
            }

            function calcularSubtotalapersonalizado(productoPersonalizado, subtotalf) {
                let cantidad = productoPersonalizado.cantidad || 1;
                let subtotal = cantidad * subtotalf;
                return subtotal;
            }






            // Al cargar la página, mostrar los productos personalizados en la tabla y calcular el total
            $(document).ready(function() {
                // Código existente para mostrar los productos no personalizados (sin cambios)

                // Mostrar los productos personalizados en la tabla y calcular el total
                mostrarProductosPersonalizados();

                // Calcular el total y actualizarlo en el DOM
                actualizarTotalEnDOM();
            });

            // Al cargar la página, mostrar los productos personalizados en la tabla y calcular el total
            $(document).ready(function() {
                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                var carritoBody = $('.carrito-body');

                var total = 0; // Variable para almacenar el total del pedido

                if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                    productosPersonalizadosGuardados.forEach(function(productoPersonalizado, index) {


                        // Agregar botón de eliminar para productos personalizados
                        let columnaAcciones = document.createElement('td');
                        let botonEliminar = document.createElement('button');
                        botonEliminar.textContent = 'Eliminar';
                        botonEliminar.className = 'btn thirdd';
                        botonEliminar.addEventListener('click', function() {
                            eliminarProductoPersonalizado(index);
                        });
                        columnaAcciones.appendChild(botonEliminar);
                        row.append(columnaAcciones);


                    });


                }

            });



            function eliminarProductoPersonalizado(index) {
                // Mostrar la alerta de confirmación usando Swal.fire
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas eliminar este producto personalizado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let productosPersonalizadosGuardados = JSON.parse(localStorage.getItem(
                            'productosPersonalizados')) || [];
                        productosPersonalizadosGuardados.splice(index, 1);
                        localStorage.setItem('productosPersonalizados', JSON.stringify(
                            productosPersonalizadosGuardados));
                        // Volver a cargar los productos personalizados en la tabla
                        mostrarProductosPersonalizados();
                        // Actualizar el total en el DOM
                        actualizarTotalEnDOM();

                        // Mostrar una alerta de éxito con Swal.fire si se elimina el producto
                        Swal.fire(
                            '¡Eliminado!',
                            'El producto personalizado ha sido eliminado.',
                            'success'
                        );
                    }
                });
            }


            function actualizarCantidadCarrito(indice, cantidad) {
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                carrito[indice].cantidad = cantidad;
                carrito[indice].subtotal = carrito[indice].precio * cantidad; // Actualizar el subtotal
                localStorage.setItem('carrito', JSON.stringify(carrito));
                actualizarSubtotalEnDOM(indice, carrito[indice].subtotal); // Actualizar el subtotal en el DOM
                actualizarTotalEnDOM(); // Actualizar el total en el DOM
            }

            function actualizarSubtotalEnDOM(indice, subtotal) {
                let tablaCarrito = document.querySelector('.carrito-body');
                let fila = tablaCarrito.children[indice];
                let columnaSubtotal = fila.querySelector('td:nth-child(4)');
                columnaSubtotal.textContent = subtotal;
            }
            // card
            // card
            // card
            // card
            document.addEventListener("DOMContentLoaded", function() {
                let productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) || [];

                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                let tablaCarrito = document.querySelector('.carrito-body');
                tablaCarrito.innerHTML = '';
                let total = 0; // Variable para almacenar el total del pedido
                function actualizarTablaCarrito() {
                    tablaCarrito.innerHTML = ''; // Limpiar la tabla antes de mostrar los productos actualizados
                    totalPedido = 0;

                    carrito.forEach(function(producto, indice) {
                        let fila = document.createElement('tr');

                        // Código para agregar las celdas de cada producto en la fila (nombre, precio, cantidad, subtotal)

                        tablaCarrito.appendChild(fila);

                        // Actualizar el total del pedido
                        totalPedido += producto.subtotal;
                    });

                    // Mostrar el total actualizado en el DOM
                    document.getElementById('totalPedido').textContent = totalPedido;
                }

                function eliminarProductoCarrito(indice) {
                    // Mostrar la alerta de confirmación usando Swal.fire
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Deseas eliminar este producto del carrito?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            carrito.splice(indice, 1);
                            localStorage.setItem('carrito', JSON.stringify(carrito));

                            // Eliminar la fila correspondiente al producto eliminado
                            tablaCarrito.removeChild(tablaCarrito.children[indice]);

                            // Actualizar los índices de los botones de eliminar restantes en la tabla
                            let botonesEliminar = tablaCarrito.querySelectorAll('.btn.thirdd');
                            botonesEliminar.forEach(function(boton, nuevoIndice) {
                                boton.setAttribute('data-indice', nuevoIndice);
                            });

                            // Actualizar el total del pedido después de eliminar el producto
                            actualizarTotalEnDOM();

                            // Mostrar una alerta de éxito con Swal.fire si se elimina el producto
                            Swal.fire(
                                '¡Eliminado!',
                                'El producto ha sido eliminado del carrito.',
                                'success'
                            );
                        }
                    });
                }

                carrito.forEach(function(producto) {
                    let fila = document.createElement('tr');

                    let columnaProducto = document.createElement('td');
                    columnaProducto.textContent = producto.nombre; // Nombre del producto
                    fila.appendChild(columnaProducto);

                    let columnaPrecio = document.createElement('td');
                    columnaPrecio.textContent = producto.precio; // Precio del producto
                    fila.appendChild(columnaPrecio);

                    let columnaCantidad = document.createElement('td');

                    let inputCantidad = document.createElement('input');
                    inputCantidad.type = 'number';
                    inputCantidad.min = 1;
                    inputCantidad.value = producto.cantidad;

                    // Add event listener for 'input' event to validate the input
                    inputCantidad.addEventListener('input', function() {
                        const inputValue = inputCantidad.value.trim();
                        const validNumberRegex = /^\d+$/;

                        if (!validNumberRegex.test(inputValue)) {
                            // If the input doesn't match the regular expression (contains 'e' or non-numeric characters)
                            // Set the value to the previous valid value (producto.cantidad)
                            inputCantidad.value = producto.cantidad;
                        } else {
                            // If the input is valid, update the cantidad in the carrito
                            actualizarCantidadCarrito(carrito.indexOf(producto), parseInt(inputValue));
                        }
                    });
                    columnaCantidad.appendChild(inputCantidad);
                    fila.appendChild(columnaCantidad);

                    let columnaSubtotal = document.createElement('td');
                    producto.subtotal = producto.precio * producto.cantidad; // Calcular el subtotal
                    columnaSubtotal.textContent = producto.subtotal;
                    fila.appendChild(columnaSubtotal);

                    let columnaAcciones = document.createElement('td');

                    let botonEliminar = document.createElement('button');
                    botonEliminar.innerHTML = '<i class="fas fa-trash"></i>';
                    botonEliminar.className = 'btn thirdd';
                    botonEliminar.addEventListener('click', function() {
                        eliminarProductoCarrito(carrito.indexOf(producto));
                        actualizarTotalCarrito();

                    });


                    columnaAcciones.appendChild(botonEliminar);
                    fila.appendChild(columnaAcciones);

                    tablaCarrito.appendChild(fila);

                });


                let totalPedido = calcularTotalPedido();
                document.getElementById('totalPedido').textContent = totalPedido;



                // Actualizar el valor del campo oculto con los productos personalizados
                document.getElementById('productosPersonalizados').value = JSON.stringify(productosPersonalizados);
            });









            document.getElementById('formulario-guadar-pedido').addEventListener('submit', function(event) {
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                document.getElementById('carrito').value = JSON.stringify(carrito);
            });

            // eliminar de card|

            document.getElementById('formulario-guadar-pedido').addEventListener('submit', function(event) {
                event.preventDefault(); // Evita que el formulario se envíe de inmediato

                // Aquí puedes realizar las operaciones que desees antes de enviar el formulario
                // Por ejemplo, si necesitas validar algo antes de enviar el pedido, puedes hacerlo aquí

                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                document.getElementById('carrito').value = JSON.stringify(carrito);

                // Mostrar el mensaje de confirmación para guardar el pedido
                confirmarGuardarPedido();
            });



            function confirmarGuardarPedido() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción guardará el pedido.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                        let carritoInput = document.getElementById('carrito');
                        carritoInput.value = JSON.stringify(carrito);
                        var form = document.getElementById('formulario-guadar-pedido');
                        form.submit();
                        localStorage.removeItem('carrito'); // Borra el carrito del Local Storage
                        localStorage.removeItem('productosPersonalizados'); // Borra el carrito del Local Storage
                    }
                });
            }


            function mostrarAlerta() {
                Swal.fire({
                    title: 'Usted no está registrado',
                    text: 'Para tener acceso a este servicio debes iniciar sesión. ¿Desea iniciar sesión?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Iniciar sesión'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }









            $(document).ready(function() {
                // Inicializar DataTable en la tabla
                $('#carritoTabla').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json' // Cargar el archivo de traducción en español
                    }
                });
            });
        </script>





        <style>
            .third {
                border-color: #0069D9;
                color: #ffffff;
                box-shadow: 0 0 40px 40px #007bff inset, 0 0 0 0 #037bfc;
                -webkit-transition: all 150ms ease-in-out;
                transition: all 150ms ease-in-out;
            }

            .third:hover {
                box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
                color: #000000;

            }

            .thirdd {
                border-color: #ae0017;
                color: #ffffff;
                box-shadow: 0 0 40px 40px #ae0017 inset, 0 0 0 0 #ae0017;
                -webkit-transition: all 150ms ease-in-out;
                transition: all 150ms ease-in-out;
            }

            .thirdd:hover {
                box-shadow: 0 0 10px 0 #eb0221 inset, 0 0 10px 4px #ff0022;
                color: #000000;

            }
        </style>
        <!-- ALL JS FILES -->


    </body>

@endsection
