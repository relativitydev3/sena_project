@extends('layouts.app')

@section('title', 'Crear Pedido')
@section('content')

    <section class=""style="">
        <div
            style="
            padding: 40px;
            background-color: #ffffff;
            border: 1px solid #ffffff;
            margin-bottom: 20px;
            height: 5em;
            position: relative;
            width: 106%;
            right: 2.3em;
            bottom: 1em;
            ">
            <div class="section-header">
                <div style="display: flex;position: relative;bottom: 1em">

                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0">Crear Pedido</h3>
                </div>
            </div>

        </div>

        <div class="section-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">



                            <div class="container">
                                <ul class="product-list">
                                    <li>
                                        <h2>Productos</h2>
                                    </li>
                                    <div class="form-group">
                                        <label for="busqueda">Buscar producto:</label>
                                        <input type="text" id="busqueda" class="form-control"
                                            placeholder="Ingrese el nombre del producto">
                                    </div>
                                    <button class="btn btn-info btn-sm " data-toggle="modal"
                                        data-target="#Personalizados">Personalizados</button>



                                    <!-- Modal Personalizados-->
                                    <div class="modal fade my-modal" id="Personalizados" tabindex="-1" role="dialog"
                                        aria-labelledby="Personalizados" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h2 style="" class="modal-title" id="Personalizados">Producto
                                                        Personalizados</h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>Selecciona 3 insumos para crear un producto personalizado.</h4>
                                                    </div>
                                                    <div style="display: flex">
                                                        <div class="insumos"
                                                            style="flex: 1; margin-right: 20px; overflow-y: scroll; max-height: 20em;">
                                                            <div class="form-group">
                                                                <input
                                                                    style="border-top: none; border-right: none; border-left: none;"
                                                                    type="text" class="form-control" id="buscarInsumo"
                                                                    placeholder="Ingresa el nombre del insumo">
                                                            </div>

                                                            <table class="table">
                                                                <tbody>
                                                                    @foreach ($Insumo as $Insumos)
                                                                        <tr class="insumo" data-id="{{ $Insumos->id }}">
                                                                            <td><img src="{{ asset($Insumos->imagen) }}"
                                                                                    alt="Imagen del producto"
                                                                                    width="40em"></td>
                                                                            <td>{{ $Insumos->id }}</td>
                                                                            <td>{{ $Insumos->nombre }}</td>
                                                                            <td>${{ $Insumos->precio_unitario }}</td>
                                                                            <td>
                                                                                <button type="button"
                                                                                    class="btn btn-success agregar-insumo"
                                                                                    style="max-width: 1em; max-height: 1.5em;">
                                                                                    <i class="fas fa-plus fa-xs"
                                                                                        style="position: relative; bottom: 8.5px;right: 5px"></i>
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
                                                                    @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <div class="insumos_selecionados"
                                                            style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 20em;">
                                                            <h3>Insumo seleccionados</h3>
                                                            <div id="totalInsumosSeleccionados">
                                                                Total: $0.00
                                                            </div>
                                                            <ul class="lista-insumos-seleccionados"></ul>
                                                            <!-- Agrega esta tabla en el modal donde deseas mostrar los insumos seleccionados -->
                                                            <div class="insumos_selecionados"
                                                                style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 20em;">
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
                                                <div
                                                    style="display: flex;align-items: center ;justify-content: center;padding: 0em; position: relative;bottom: 1em;">

                                                    <div class="form-group"
                                                        style="margin: 0em;padding: 0em;width: 75%;;position: relative;bottom: 1em">
                                                        <label for="descripcionnn">Descripción:</label>
                                                        <textarea class="form-control" maxlength="200"
                                                            style="width: 100%; height: 3em !important; resize: none; position: relative; right: 1em !important;"
                                                            id="descripcionnn"></textarea>
                                                    </div>


                                                    <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                                                    <div class="modal-footer" style="margin: 0em;padding: 0em;">
                                                        <button type="button" class="btn btn-primary"
                                                            id="crearPersonalizados" data-dismiss="modal"
                                                            onclick=" mostrarAlertaExitosa('Producto agregado al carrito exitosamente');">
                                                            Crear
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
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



                                    @foreach ($productos as $producto)
                                        @if ($producto->activo)
                                            <li>

                                                <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto"
                                                    width="40em">
                                                <span>{{ $producto->id }}:{{ $producto->nombre }}
                                                    <br>$: {{ number_format($producto->precio, 0, ',', '.') }} </span>
                                                <button class="btn btn-primary btn-sm float-right"
                                                    onclick="agregarProducto('{{ $producto->id }}', '{{ $producto->nombre }}','{{ $producto->precio }}')">Agregar</button>
                                                <button class="btn btn-info btn-sm float-right" data-toggle="modal"
                                                    data-target="#productModal_{{ $producto->id }}">Detalles</button>
                                            </li>

                                            <!-- Modal productModal-->
                                            <div class="modal fade my-modal" id="productModal_{{ $producto->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="productModalLabel_{{ $producto->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="productModalLabel_{{ $producto->id }}">Detalles del
                                                                producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <img src="{{ asset($producto->imagen) }}"
                                                                        alt="{{ $producto->nombre }}" class="img-fluid">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                                                                    @foreach ($Categorium as $Categoriu)
                                                                        <p><strong>Categoria:</strong>
                                                                            {{ $Categoriu->nombre }}</p>
                                                                    @endforeach
                                                                    <p><strong>Insumos:</strong></p>
                                                                    <ul>
                                                                        @foreach ($producto->insumos as $insumo)
                                                                            <li>{{ $insumo->nombre }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <p><strong>Descripción:</strong>
                                                                        {{ $producto->descripcion }}</p>
                                                                    <p><strong>Precio:</strong> ${{ $producto->precio }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <!-- Agrega aquí más detalles del producto si es necesario -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="selected-products-container">
                                <form action="{{ route('pedidos.store') }}" method="POST">

                                    @csrf

                                    <div class="">

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="Usuario">Usuario:</label>
                                                <select name="Usuario" id="Usuario" class="form-control select2"
                                                    data-live-search="true" required>
                                                    <option value="">Seleccionar Usuario</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->documento }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <input type="hidden" name="Productos[]" id="productos-seleccionados-input">
                                            <h2>Productos Seleccionados:</h2>
                                            <div class="table" style="width: 48em">
                                                {{-- -responsive --}}
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Cantidad</th>
                                                            <th>Subtotal</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="selected-products-list">

                                                    </tbody>
                                                    <input type="hidden" name="personalizadosArray"
                                                        id="personalizadosArray">

                                                </table>
                                            </div>

                                            <h4 id="total-section" style="display: none;">Total: $<span
                                                    id="total">0</span></h4>
                                            <input type="hidden" name="Total" id="total-input" value="">
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="Nombre">Descripción:</label>
                                                <input type="text" name="Nombre" id="Nombre"
                                                    class="form-control">
                                            </div>
                                            <Script>
                                                let nombreInput = document.getElementById('Nombre');

                                                // Add event listener for 'blur' event to trim the input value
                                                nombreInput.addEventListener('blur', function() {
                                                    nombreInput.value = nombreInput.value.trim();
                                                });
                                            </Script>
                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary">Crear Pedido</button>
                                                {{-- <a class="btn btn-dark" href="{{ route('pedidos.index') }}">Regresar</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal para mostrar detalles del producto personalizado -->
                            <div class="modal fade my-modal" id="personalizadoDetallesModal" tabindex="-1"
                                role="dialog" aria-labelledby="personalizadoDetallesModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="personalizadoDetallesModalLabel">Detalles del
                                                Producto Personalizado</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="modal-nombre">Nombre:</h6>
                                            <ul id="modalPersonalizadoInsumos" class="">
                                                <!-- Insumos se agregarán aquí -->
                                            </ul>
                                            <p class="modal-descripcion">Descripción:</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#personalizadoDetallesModal').on('show.bs.modal', function(event) {
                                        var button = $(event.relatedTarget);
                                        var index = button.data('index'); // Índice del producto personalizado
                                        var productoPersonalizado = personalizadosArray[index]; // Obtener el producto personalizado

                                        var modal = $(this);
                                        modal.find('.modal-title').text('Detalles del Producto Personalizado');
                                        modal.find('.modal-nombre').text('Nombre: ' + productoPersonalizado.Nombre);

                                        var insumosList = modal.find('#modalPersonalizadoInsumos');
                                        insumosList.empty();

                                        productoPersonalizado.insumos.forEach(function(insumo) {
                                            var insumoItem = $('<li>').text(insumo);
                                            insumosList.append(insumoItem);
                                        });

                                        // Agregar la descripción al modal
                                        modal.find('.modal-descripcion').text('Descripción: ' + productoPersonalizado.Descripcion);
                                    });
                                });
                            </script>




                            <script>
                                var totalElement = document.getElementById('total');

                                var totalSection = document.getElementById('total-section');
                                var total = 0; // Inicializar el total en 0



                                function agregarProducto(id, nombre, precio) {
                                    Swal.fire({
                                        title: 'Ingrese la cantidad para el producto:',
                                        input: 'number',
                                        inputValue: 1,
                                        showCancelButton: true,
                                        confirmButtonText: 'Aceptar',
                                        cancelButtonText: 'Cancelar',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            var cantidad = parseInt(result.value);

                                            if (!isNaN(cantidad) && cantidad > 0) {
                                                var subtotal = cantidad * precio;

                                                var productosSeleccionados = document.getElementById('selected-products-list');
                                                var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');
                                                var existingRow = productosSeleccionados.querySelector(`tr[data-producto-id="${id}"]`);

                                                if (existingRow) {
                                                    var existingCantidad = parseInt(existingRow.getAttribute('data-cantidad'));
                                                    var newCantidad = existingCantidad + cantidad;
                                                    var newSubtotal = newCantidad * precio;

                                                    existingRow.setAttribute('data-cantidad', newCantidad);
                                                    existingRow.setAttribute('data-subtotal', newSubtotal);
                                                    existingRow.querySelector('td:nth-child(2)').textContent = newCantidad;
                                                    existingRow.querySelector('td:nth-child(3)').textContent = newSubtotal.toLocaleString(
                                                        'en-US');
                                                } else {
                                                    var row = document.createElement('tr');
                                                    row.setAttribute('data-producto-id', id);
                                                    row.setAttribute('data-cantidad', cantidad);
                                                    row.setAttribute('data-subtotal', subtotal);
                                                    row.innerHTML = `
                                                        <td>${nombre}</td>
                                                        <td>${cantidad}</td>
                                                        <td>${subtotal.toLocaleString('en-US')}</td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm quitar-btn" onclick="quitarProducto('${id}')">
                                                                <li class="fas fa-trash"></li>
                                                            </button>
                                                        </td>
                                                    `;
                                                    productosSeleccionados.appendChild(row);
                                                }

                                                // Actualizar el total después de todas las operaciones
                                                total += subtotal;

                                                var totalFormateado = total.toLocaleString(undefined, {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                });
                                                totalElement.textContent = totalFormateado;
                                                totalSection.style.display = 'block';

                                                var totalInput = document.getElementById('total-input');
                                                totalInput.value = total.toFixed(2);

                                                // Resto del código para actualizar inputs y totales...
                                                var inputCantidad = document.createElement('input');
                                                inputCantidad.type = 'hidden';
                                                inputCantidad.name = 'Cantidad[]';
                                                inputCantidad.value = cantidad;
                                                row.appendChild(inputCantidad);

                                                var inputProductoID = document.createElement('input');
                                                inputProductoID.type = 'hidden';
                                                inputProductoID.name = 'ProductoID[]';
                                                inputProductoID.value = id;
                                                row.appendChild(inputProductoID);

                                                var productosSeleccionadosArray = Array.from(productosSeleccionados.querySelectorAll('tr'))
                                                    .map(function(
                                                        row) {
                                                        return row.getAttribute('data-producto-id');
                                                    });
                                                inputProductosSeleccionados.value = productosSeleccionadosArray.join(', ');
                                            }
                                        }
                                    });
                                }

                                function quitarProducto(id) {
                                    var producto = document.querySelector(`tr[data-producto-id="${id}"]`);
                                    var cantidad = parseInt(producto.getAttribute('data-cantidad'));
                                    var subtotal = parseInt(producto.getAttribute('data-subtotal'));

                                    producto.remove();

                                    total -= subtotal;

                                    totalElement.textContent = total.toFixed(2);

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);

                                    var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');
                                    var productosSeleccionados = Array.from(document.querySelectorAll('#selected-products-list tr')).map(function(
                                        tr) {
                                        return tr.textContent.split('\t');
                                    });

                                    inputProductosSeleccionados.value = JSON.stringify(productosSeleccionados);

                                    var inputCantidad = document.createElement('input');
                                    inputCantidad.type = 'hidden';
                                    inputCantidad.name = 'Cantidad[]';
                                    inputCantidad.value = cantidad;
                                    productosSeleccionados.appendChild(inputCantidad);

                                    var inputProductoID = document.createElement('input');
                                    inputProductoID.type = 'hidden';
                                    inputProductoID.name = 'ProductoID[]';
                                    inputProductoID.value = id;
                                    productosSeleccionados.appendChild(inputProductoID);
                                    personalizadosArray.splice(id, 1);

                                }
                            </script>



                            <script>
                                const busquedaInput = document.getElementById('busqueda');
                                const productItems = document.querySelectorAll('.product-list li');

                                busquedaInput.addEventListener('input', function() {
                                    const searchTerm = busquedaInput.value.toLowerCase();

                                    productItems.forEach(function(item) {
                                        const nombreProducto = item.textContent.toLowerCase();

                                        if (nombreProducto.includes(searchTerm)) {
                                            item.style.display = 'block';
                                        } else {
                                            item.style.display = 'none';
                                        }
                                    });
                                });
                            </script>

                            <script>
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
                                                'Debes seleccionar 3 insumo para crear un producto personalizado.');
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

                                        var productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) ||
                                            [];
                                        productosPersonalizados.push(personalizado);
                                        localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizados));


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

                                    $('#Personalizados').on('hidden.bs.modal', function() {
                                        // Clear all the input fields, selected items, and any other content within the modal
                                        // $('#descripcionnn').val(''); // Clear description field
                                        $('.tabla-insumos-seleccionados tbody').empty(); // Clear selected insumos
                                        insumosSeleccionadosSet.clear(); // Clear selected insumos set
                                        insumosCantidad = {}; // Clear insumosCantidad object
                                        recalcularTotalInsumosSeleccionados(); // Recalculate total
                                    });
                                });


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
                            </script>

                            <script>
                                var personalizadosArray = [];

                                document.getElementById('crearPersonalizados').addEventListener('click', function() {
                                    var insumosSeleccionados = Array.from(document.querySelectorAll(
                                        '.tabla-insumos-seleccionados tbody tr')).map(function(row) {
                                        var id = row.querySelector('td:nth-child(1)').textContent.trim();
                                        var nombre = row.querySelector('td:nth-child(2)').textContent.trim();
                                        var cantidad = row.querySelector('td:nth-child(3)').textContent.trim();
                                        // var precio = row.querySelector('td:nth-child(4)').textContent.trim();
                                        var precioTexto = row.querySelector('td:nth-child(4)').textContent
                                            .trim(); // Supongamos que obtienes "$1,000"
                                        var precioNumerico = precioTexto.replace(/[$,]/g, '');
                                        return `${id} : ${nombre}  : ${precioNumerico} (cantidad: ${cantidad})`;
                                    });
                                    // alert(JSON.stringify(insumosSeleccionados));
                                    Swal.fire({
                                        title: 'Ingrese la cantidad para el producto personalizado:',
                                        input: 'number',
                                        inputValue: 1,
                                        showCancelButton: true,
                                        confirmButtonText: 'Aceptar',
                                        cancelButtonText: 'Cancelar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            var cantidad = result.value;

                                            if (!isNaN(cantidad) && cantidad > 0) {
                                                cantidad = parseInt(cantidad);

                                                var tableBody = document.getElementById('selected-products-list');
                                                var subtotal = 0;

                                                insumosSeleccionados.forEach(function(insumo) {
                                                    var data = insumo.split(':');
                                                    var precio = parseFloat(data[2].trim());
                                                    var CantidaInsumo = parseFloat(data[3].trim());

                                                    subtotal += (precio * CantidaInsumo) * cantidad;
                                                });
                                                var descripcionnn = document.getElementById('descripcionnn')
                                                    .value; // Obtener el valor de la descripción
                                                // alert();
                                                // alert(JSON.stringify(descripcionnn));

                                                var personalizado = {
                                                    'Nombre': 'Personalizado ' + (personalizadosArray.length + 1),
                                                    'insumos': insumosSeleccionados,
                                                    'Subtotal': subtotal,
                                                    'Cantidad': cantidad,
                                                    'Descripcion': descripcionnn // Agregar la descripción al objeto personalizado

                                                };
                                                personalizadosArray.push(personalizado);

                                                var row = document.createElement('tr');
                                                var uniqueId = personalizadosArray.length - 1;
                                                row.innerHTML = `
                                                <td>${personalizado.Nombre}</td>
                                                <td>${cantidad}</td>
                                                <td>${subtotal.toLocaleString('en-US')}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm quitar-btn" onclick="quitarProductoPersonalizados(${uniqueId})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-info btn-sm detalles-btn" data-index="${uniqueId}" data-toggle="modal" data-target="#personalizadoDetallesModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            `;
                                                row.setAttribute('data-id', uniqueId);
                                                tableBody.appendChild(row);

                                                total += subtotal;
                                                totalElement.textContent = total.toFixed(2);
                                                totalSection.style.display = 'block';

                                                var totalInput = document.getElementById('total-input');
                                                totalInput.value = total.toFixed(2);

                                                var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                                personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                                // alert(JSON.stringify(personalizadosArray));
                                            } else {
                                                console.log('Cantidad no válida');
                                            }
                                        }

                                    });

                                });

                                function quitarProductoPersonalizados(index) {
                                    var productoPersonalizado = personalizadosArray[index];
                                    var subtotal = productoPersonalizado.Subtotal;
                                    personalizadosArray.splice(index, 1); // Eliminar el producto personalizado del array

                                    var tableBody = document.getElementById('selected-products-list');
                                    var row = document.querySelector(`tr[data-id="${index}"]`);
                                    row.remove();
                                    total -= subtotal;

                                    var totalElement = document.getElementById('total');
                                    totalElement.textContent = total.toFixed(2);

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);

                                    var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                    personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .container {
            width: 20em;
            height: 100vh;
            overflow-y: scroll;
            float: right;
        }

        .product-list {
            list-style-type: none;
            padding: 0;
        }

        .product-list li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
@endsection
