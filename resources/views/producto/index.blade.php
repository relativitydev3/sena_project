@extends('layouts.app')

@section('title')
    Productos
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Productos</h3>
        </div>
        <div class="section-body">
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
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div style="margin-bottom: 20px;">
                            <a class="btn btn-warning" href="{{ route('productos.create') }}">Nuevo</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef" class="thead">
                                    <tr>
                                        <th style="color:#fff;">No</th>
                                        <th style="color:#fff;">Imagen</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">Precio</th>
                                        <th style="color:#fff;">Descripción</th>
                                        <th style="color:#fff;">Estado</th>
                                        <th style="color:#fff;">Nombre de categoría</th>
                                        {{-- <th style="color:#fff;">Personalizado</th> --}}
                                        <th style="color:#fff;">Insumo</th>
                                        <th style="color:#fff;">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $contador = 1 @endphp
                                    @foreach ($productos as $producto)
                                        @if ($producto->activo)
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>
                                                    @if ($producto->imagen)
                                                        <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto"
                                                            width="25">
                                                    @else
                                                        Sin imagen
                                                    @endif
                                                </td>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ number_format($producto->precio, 0, '.', '.') }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td> <span class="badge badge-success">Activo</span>
                                                <td>{{ $producto->categorium->nombre }}</td>
                                                {{-- <td>
                                                    @if ($producto->personalizado)
                                                        <span class="badge badge-primary">Personalizado</span>
                                                    @else
                                                        <span class="badge badge-success">Normal</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    @foreach ($producto->insumos as $insumo)
                                                        {{ $insumo->nombre }}
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form action="{{ route('productos.destroy', $producto->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('productos.show', $producto->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> </a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('productos.edit', $producto->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            onclick="confirmChangeStatus(event)">
                                                            <i class="fa fa-fw fa-toggle-on"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php $contador++ @endphp
                                        @endif
                                    @endforeach
                                    <!-- Mostrar productos inactivos -->
                                    @foreach ($productos as $producto)
                                        @if (!$producto->activo)
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>
                                                    @if ($producto->imagen)
                                                        <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto"
                                                            width="25">
                                                    @else
                                                        Sin imagen
                                                    @endif
                                                </td>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ number_format($producto->precio, 0, '.', '.') }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td> <span class="badge badge-danger">Inactivo</span> </td>
                                                <td>{{ $producto->categorium->nombre }}</td>
                                                {{-- <td>
                                                    @if ($producto->personalizado)
                                                        <span class="badge badge-primary">Personalizado</span>
                                                    @else
                                                        <span class="badge badge-success">Normal</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    @foreach ($producto->insumos as $insumo)
                                                        {{ $insumo->nombre }}
                                                        <br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form action="{{ route('productos.destroy', $producto->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('productos.show', $producto->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> </a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('productos.edit', $producto->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            onclick="confirmChangeStatus(event)">
                                                            <i class="fa fa-fw fa-toggle-off"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <!-- Mostrar productos inactivos -->

                                </tbody>
                            </table>

                        </div>
                        <!-- Centramos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $productos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    // Sweet alert
    <script>
        function confirmChangeStatus(event) {
            event.preventDefault(); // Evita la acción por defecto del botón

            Swal.fire({
                title: 'Confirmar Cambio de Estado',
                text: '¿Estás seguro de que quieres cambiar el estado de este producto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cambiar Estado',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, envía el formulario
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "language": {
                    "decimal": "",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ registros.",
                    "infoEmpty": "Mostrando 0 al 0 de 0 registros.",
                    "infoFiltered": "(Filtrado de _MAX_ registros en total.)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros.",
                    "loadingRecords": "Cargando...",
                    "processing": "",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes.",
                    "paginate": {
                        "first": "Primero",
                        "last": "último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de forma ascendente.",
                        "sortDescending": ": Activar para ordenar la columna de forma descendente."
                    }
                },
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
