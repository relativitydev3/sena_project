@extends('layouts.app')

@section('title', 'Editar Pedido')
@section('content')

    {{-- <section class="section"> --}}
    <section class="" style="">
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
                    <h3 class="page__heading ml-3 mb-0">Editar Pedido</h3>
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
                                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="">
                                        <div class="col-md-6">

                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Usuario">Usuario:</label>
                                                        <select name="Usuario" id="Usuario"
                                                            class="form-control select2" data-live-search="true" required>
                                                            @foreach ($users as $user)

                                                        {{-- @if ($user->estado != 1) --}}

                                                                @if ($pedido->id_users == $user->id)
                                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                                    {{ $user->documento }}</option>
                                                                @else
                                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                                    {{ $user->documento }}</option>
                                                                @endif
                                                        {{-- @endif --}}

                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Estado">Estado</label>
                                                        <select name="Estado" id="Estado"
                                                            class="form-control select2" data-live-search="true" required>

                                                            <option value="">Seleccionar Estado</option>
                                                            <option value="En_proceso"
                                                                {{ $pedido->Estado == 'En_proceso' ? 'selected' : '' }}>En
                                                                proceso</option>
                                                            <option value="Finalizado"
                                                                {{ $pedido->Estado == 'Finalizado' ? 'selected' : '' }}>
                                                                Finalizado
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <h2>Productos Seleccionados:</h2>
                                                <input type="hidden" name="Productos[]"
                                                    id="productos-seleccionados-input">
                                                <div class="table" style="width: 48em">

                                                    <table style="width: 48em" id="selected-products-table"
                                                        class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Subtotal</th>
                                                                <th>Opciones</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="selected-products-list">
                                                            @foreach ($pedido->productos as $producto)
                                                                <tr data-producto-id="{{ $producto->id }}"
                                                                    data-cantidad="{{ $producto->pivot->cantidad }}"
                                                                    data-subtotal="{{ $producto->precio * $producto->pivot->cantidad }}">
                                                                    <td>{{ $producto->nombre }}</td>
                                                                    <td>{{ $producto->pivot->cantidad }}</td>
                                                                    <td>$
                                                                        {{ number_format($producto->precio * $producto->pivot->cantidad, 0, ',', '.') }}
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm quitar-btn"
                                                                            onclick="quitarProducto('{{ $producto->id }}')">
                                                                            <li class="fas fa-trash"></li>
                                                                        </button>
                                                                    </td>
                                                                    <input type="hidden" name="Cantidad[]"
                                                                        value="{{ $producto->pivot->cantidad }}">
                                                                    <input type="hidden" name="ProductoID[]"
                                                                        value="{{ $producto->id }}">
                                                                </tr>
                                                            @endforeach
                                                            <?php $per = 'Personalizado '; ?>
                                                            @foreach ($personaliza as $personalizas)
                                                                @if (!($personalizas->nombre == $per))
                                                                    <?php
                                                                    $per = $personalizas->nombre;
                                                                    $lastSubtotal = null; // Initialize the variable to store the last Subtotal for the current $per
                                                                    ?>
                                                                    @foreach ($personaliza as $personalizaInner)
                                                                        <!-- Loop through the personaliza array again to find the last Subtotal for the current $per -->
                                                                        @if ($personalizaInner->nombre == $per)
                                                                            <?php $lastSubtotal = $personalizaInner->Subtotal; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    <tr>
                                                                        <td>{{ $personalizas->nombre }}</td>
                                                                        <td>{{ $personalizas->cantidad }}</td>
                                                                        <td>{{ number_format($lastSubtotal, 0, ',', '.') }}
                                                                        </td>
                                                                        <!-- Print the last Subtotal for the current $per -->
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm quitar-btn"
                                                                                onclick="quitarProductoPersonalizados2(this)">
                                                                                <li class="fas fa-trash"></li>
                                                                            </button>

                                                                            <button type="button"
                                                                                class="btn btn-info btn-sm  "
                                                                                data-toggle="modal"
                                                                                data-target="#productModalper_{{ $personalizas->insumos }}"
                                                                                data-details="{{ json_encode($personalizas) }}"
                                                                                data-descripcionn="{{ $personalizas->Descripción }}"
                                                                                data-datos="{{ $personalizas->datos }}"><i
                                                                                    class="fas fa-eye"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach




                                                        </tbody>
                                                        <input type="hidden" name="personalizadosArray"
                                                            id="personalizadosArray">

                                                        <input type="hidden" name="personalizadosArray2"
                                                            id="personalizadosArray2">
                                                    </table>
                                                </div>


                                                <h4>Total: $<span id="total">{{ $pedido->Total }}</span></h4>
                                                <input type="hidden" name="Total" id="total-input"
                                                    value="{{ $pedido->Total }}">



                                            </div>

                                            <div class="form-group">
                                                <label for="Nombre">Descripción:</label>
                                                <input type="text" value="{{ $pedido->Descripcion }}" name="Nombre"
                                                    id="Nombre" class="form-control">
                                            </div>
                                            <Script>
                                                let nombreInput = document.getElementById('Nombre');

                                                // Add event listener for 'blur' event to trim the input value
                                                nombreInput.addEventListener('blur', function() {
                                                    nombreInput.value = nombreInput.value.trim();
                                                });
                                            </Script>

                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
                                                {{-- <a class="btn btn-dark" href="{{ route('pedidos.index') }}">Regresar</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- productModalper_ --}}

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


                            <!-- Aquí se encuentran los modales -->
                            @foreach ($personaliza as $personalizas)
                                <div class="modal fade my-modal     personaliza-modal"
                                    id="productModalper_{{ $personalizas->insumos }}" tabindex="-1" role="dialog"
                                    aria-labelledby="productModalperLabel_{{ $personalizas->insumos }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="productModalperLabel_{{ $personalizas->insumos }}">
                                                    Detalles del producto</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body ">
                                                <h6 class="Nombre">
                                                    <strong>Nombre:</strong> {{ $personalizas->nombre }}
                                                </h6>
                                                <div id="productModalperIngredients_{{ $personalizas->insumos }}">
                                                    <!-- Ingredientes se agregarán aquí utilizando jQuery -->
                                                </div>
                                                <p><strong>Descripción:</strong> <span class="modal-descripcionn"></span>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <script>
                                $(document).ready(function() {
                                    $('.personaliza-modal').on('show.bs.modal', function(event) {
                                        var button = $(event.relatedTarget);
                                        var details = button.data('details');
                                        var datos = button.data('datos');
                                        var descripcionn = button.data('descripcionn'); // Obtiene la descripción
                                        var modal = $(this);

                                        modal.find('.modal-title').text('Detalles del producto: ' + details.nombre);
                                        modal.find('.modal-body .modal-descripcionn').text('Descripción: ' + descripcionn);
                                        var ingredientList = '<ul>';
                                        @foreach ($personaliza as $q)
                                            if ("{{ $q->nombre }}" == details.nombre) {
                                                var datosArray = "{{ $q->datos }}".split(',');
                                                $.each(datosArray, function(index, value) {
                                                    ingredientList += '<li><span class="highlight">' + value +
                                                        '</span></li>';
                                                });
                                            }
                                        @endforeach
                                        ingredientList += '</ul>';
                                        modal.find('.modal-body #productModalperIngredients_' + details.insumos).html(
                                            ingredientList);
                                    });
                                });
                            </script>






















                            <script>
                                function calcularTotalInicial() {
                                    var totalElement = document.getElementById('total');
                                    var total = 0; // Restablecer el total a cero antes de recalcularlo
                                    var totalInput = document.getElementById('total-input');

                                    // Sumar los subtotales de los productos
                                    var productos = document.querySelectorAll('#selected-products-list tr');
                                    productos.forEach(function(producto) {
                                        var subtotal = parseFloat(producto.getAttribute('data-subtotal'));
                                        if (!isNaN(subtotal)) {
                                            total += subtotal;
                                        }
                                    });

                                    // Sumar los subtotales de los productos personalizados
                                    var personalizados = document.querySelectorAll('#selected-products-list tr');
                                    personalizados.forEach(function(personalizado) {
                                        var subtotal = parseFloat(personalizado.cells[2].textContent.replace(/\./g, '').replace(',', '.'));
                                        if (!isNaN(subtotal)) {
                                            total += subtotal;
                                        }
                                    });

                                    var totalFormateado = total.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;
                                    totalInput.value = total.toFixed(2);
                                    
                                }

                                window.addEventListener('load', calcularTotalInicial);
                            </script>

                            <script>
                                var totalElement = document.getElementById('total');
                                var totalInput = document.getElementById('total-input');
                                let total = parseFloat(totalElement.textContent);

                                function agregarProducto(id, nombre, precio) {
                                    Swal.fire({
                                        title: 'Ingrese la cantidad para el producto :',
                                        input: 'number',
                                        inputValue: 1, // Valor por defecto
                                        showCancelButton: true,
                                        confirmButtonText: 'Aceptar',
                                        cancelButtonText: 'Cancelar',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            var cantidad = result.value;
                                            console.log('Cantidad ingresada:', cantidad);



                                            // var cantidad = prompt('Ingrese la cantidad del producto "' + nombre + '":');
                                            if (cantidad !== null && cantidad !== '') {
                                                cantidad = parseInt(cantidad);
                                                var subtotal = cantidad * precio;
                                                total += subtotal;

                                                var productosSeleccionados = document.getElementById('selected-products-list');
                                                var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');

                                                var row = document.createElement('tr');
                                                row.setAttribute('data-producto-id', id);
                                                row.setAttribute('data-cantidad', cantidad);
                                                row.setAttribute('data-subtotal', subtotal);
                                                row.innerHTML = `
                                                                <td>${nombre}</td>
                                                                <td>${cantidad}</td>
                                                                <td>${subtotal.toLocaleString('en-US')}</td>

                                                                <td>
                                                                    <button type="button" class="btn btn-danger btn-sm quitar-btn" onclick="quitarProducto('${id}')"> <li class="fas fa-trash"></li></button>
                                                                </td>
                                                            `;
                                                productosSeleccionados.appendChild(row);

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
                                                // Formatear el total con el punto del millar
                                                var totalFormateado = total.toLocaleString(undefined, {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                });
                                                totalElement.textContent = totalFormateado;
                                                totalSection.style.display = 'block';

                                                var totalInput = document.getElementById('total-input');
                                                totalInput.value = total.toFixed(2);
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
                                // personalizadosArray2
                                function obtenerNumeroMayorPersonalizadosArray() {
                                    var maxNum = 0;

                                    personalizadosArray.forEach(function(personalizado) {
                                        var numStr = personalizado.Nombre.match(/\d+/); // Extraer el número del nombre
                                        if (numStr) {
                                            var num = parseInt(numStr[0]);
                                            if (num > maxNum) {
                                                maxNum += num;
                                            }
                                        }
                                    });

                                    personalizadosArray2.forEach(function(personalizado) {
                                        var numStr = personalizado.Nombre.match(/\d+/); // Extraer el número del nombre
                                        if (numStr) {
                                            var num = parseInt(numStr[0]);
                                            if (num > maxNum) {
                                                maxNum += num;
                                            }
                                        }
                                    });

                                    return maxNum;
                                }

                                function obtenerNumeroMayorPersonalizadosTabla() {
                                    var maxNum = 0;

                                    var rows = document.querySelectorAll('#selected-products-list tr');
                                    rows.forEach(function(row) {
                                        var nombreCell = row.querySelector('td:nth-child(1)');
                                        if (nombreCell) {
                                            var numStr = nombreCell.textContent.match(/\d+/); // Extraer el número del nombre
                                            if (numStr) {
                                                var num = parseInt(numStr[0]);
                                                if (num > maxNum) {
                                                    maxNum = num;
                                                }
                                            }
                                        }
                                    });

                                    return maxNum;
                                }

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

                                    Swal.fire({
                                        title: 'Ingrese la cantidad para el personalizado:',
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
                                                var cd = personalizadosArray2.length + personalizadosArray.length;
                                                var newPersonalizadoName = 'Personalizado ' + (cd + 1);

                                                // Check if a personalized product with the desired name already exists
                                                var existingNames = personalizadosArray.map(item => item.Nombre);
                                                var nameExists = existingNames.includes(newPersonalizadoName);

                                                if (nameExists) {
                                                    var incrementedNumber = 2;
                                                    while (existingNames.includes(newPersonalizadoName + ' ' + incrementedNumber)) {
                                                        incrementedNumber++;
                                                    }
                                                    newPersonalizadoName += ' ' + incrementedNumber;
                                                }




                                                var personalizado = {
                                                    'Nombre': newPersonalizadoName,
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

                                                // totalSection.style.display = 'block';
                                                // alert("  ");

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

                                function quitarProductoPersonalizados(id) {
                                    // Obtener el personalizado correspondiente al ID
                                    var personalizado = personalizadosArray[id];

                                    // Restar el subtotal del producto personalizado al total general
                                    var subtotalEliminado = personalizado.Subtotal;
                                    var totalElement = document.getElementById('total');

                                    var total = parseFloat(totalElement.textContent.replace(/\./g, '').replace(',', '.'));

                                    total -= subtotalEliminado; // Restamos el subtotal del producto personalizado al total general

                                    // Actualizar el elemento de visualización del total
                                    var totalFormateado = total.toLocaleString('es-ES', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);

                                    // Eliminar el personalizado del array
                                    personalizadosArray.splice(id, 1);

                                    // Eliminar la fila de la tabla
                                    var row = document.querySelector(`#selected-products-list tr[data-id="${id}"]`);
                                    if (row) {
                                        row.remove();
                                    }

                                    // Actualizar el campo oculto con los datos actualizados
                                    var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                    personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                }










                                var personalizadosArray2 = [];
                                var nombresRepetidos = [];

                                @foreach ($personaliza as $personalizas)
                                    var personalizado = {};
                                    personalizado['Nombre'] = '{{ $personalizas->nombre }}';
                                    personalizado['Descripcion'] = '{{ $personalizas->Descripción }}';
                                    personalizado['Insumos'] = [];

                                    @foreach (\App\Models\ProducPerz::where('id', $personalizas->id)->get() as $producPerz)
                                        var insumoObj = {
                                            'id': {{ $producPerz->insumos }},
                                            'cantidad': {{ $producPerz->cantidad }},
                                        };

                                        personalizado['Insumos'].push(insumoObj);
                                    @endforeach

                                    personalizado['Subtotal'] = '{{ $personalizas->Subtotal }}';

                                    // Modificar la propiedad 'datos' para tener un formato específico
                                    var datosString = '{{ $personalizas->datos }}';
                                    var datosArray = datosString.split(' '); // Suponiendo que los datos están en el formato "id:X cantidad:Y"
                                    var datosObj = {};
                                    datosArray.forEach(function(item) {
                                        var parts = item.split(':');
                                        datosObj[parts[0]] = parts[1];
                                    });
                                    personalizado['datos'] = '{{ $personalizas->datos }}';

                                    personalizadosArray2.push(personalizado);

                                    // Verificar si el nombre de pedido ya ha sido registrado
                                    if (nombresRepetidos.indexOf('{{ $personalizas->nombre }}') === -1) {
                                        nombresRepetidos.push('{{ $personalizas->nombre }}');
                                    }
                                    // alert(JSON.stringify(personalizadosArray));
                                @endforeach


                                var totalPorNombre = {};
                                var totalGeneral = 0;

                                personalizadosArray2.forEach(function(personalizado) {
                                    var nombre = personalizado['Nombre'];
                                    var subtotal = parseFloat(personalizado['Subtotal']);

                                    if (nombresRepetidos.indexOf(nombre) !== -1) {
                                        // Solo tomar el primer total de un nombre de pedido repetido
                                        if (!totalPorNombre.hasOwnProperty(nombre)) {
                                            totalPorNombre[nombre] = subtotal;
                                            totalGeneral += subtotal;
                                        }
                                    } else {
                                        totalPorNombre[nombre] = subtotal;
                                        totalGeneral += subtotal;
                                    }

                                });
                                // Actualizar el campo oculto con los datos actualizados
                                var personalizadosArray2Input = document.getElementById('personalizadosArray2');
                                personalizadosArray2Input
                                    .value = JSON.stringify(personalizadosArray2);

                                var totalInput = document.getElementById('total-input');
                                var totalValue = parseFloat(totalInput.value);

                                // Obtener el elemento del total en el encabezado
                                var totalElement = document.getElementById('total');

                                // Obtener el valor existente en el elemento del total en el encabezado
                                var existingTotal = parseFloat(totalElement.textContent);

                                // Calcular el nuevo total sumando el valor del campo oculto al valor existente
                                var newTotal = totalValue;

                                // Actualizar el contenido del elemento del total en el encabezado con el nuevo total calculado

                                var totalFormateado = total.toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                                totalElement.textContent = totalFormateado;

                                totalInput.value = totalNuevo.toFixed(2);




                                function quitarProductoPersonalizados2(button) {
                                    var row = button.closest('tr'); // Obtener la fila que contiene el botón

                                    // Obtener los datos de la fila
                                    var nombre = row.cells[0].textContent;
                                    var cantidad = row.cells[1].textContent;
                                    var subtotal = row.cells[2].textContent.replace(/\./g, '').replace(',', '.');

                                    // Eliminar la fila de la tabla
                                    row.remove();

                                    // Actualizar el campo oculto con los datos actualizados
                                    var personalizadosArray2Input = document.getElementById('personalizadosArray2');
                                    personalizadosArray2Input.value = obtenerPersonalizadosArray2Actualizado();

                                    // Recalcular el total restando el subtotal eliminado
                                    var totalInput = document.getElementById('total-input');
                                    var total = parseFloat(totalInput.value) - parseFloat(subtotal);
                                    total = total < 0 ? 0 :
                                        total; // Verificar si el total es menor que cero y establecerlo en cero si es así
                                    totalInput.value = total.toFixed(2);

                                    // Actualizar el elemento de visualización del total
                                    var totalElement = document.getElementById('total');
                                    var totalFormateado = total.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;





                                }


                                function obtenerPersonalizadosArray2Actualizado() {
                                    var personalizadosArray2Actualizado = [];

                                    // Recorrer las filas de la tabla de personalizados
                                    var filas = document.querySelectorAll('tr[data-producto-id]');
                                    filas.forEach(function(row) {
                                        var nombre = row.cells[0].textContent;
                                        var cantidad = row.cells[1].textContent;
                                        var subtotal = row.cells[2].textContent;

                                        var personalizado = {
                                            'Nombre': nombre,
                                            'Insumos': [],
                                            'Subtotal': subtotal
                                        };

                                        personalizadosArray2Actualizado.push(personalizado);
                                    });

                                    return JSON.stringify(personalizadosArray2Actualizado);
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
