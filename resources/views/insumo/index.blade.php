@extends('layouts.app')

@section('title')
Insumo
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Insumos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="alert alert-danger">
                            <strong>¡Revise los campos¡</strong>
                        </div>
                    </div>
                    @endif

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="card-body">
                        <div style="margin-bottom: 20px;">
                            <a class="btn btn-warning" href="{{ route('insumo.create') }}">Nuevo</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef" class="thead">
                                    <tr>
                                        <th style="color:#fff;">No</th>
                                        <th style="color:#fff;">Imagen</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">Estado</th>
                                        <th style="color:#fff;">Cantidad</th>
                                        <th style="color:#fff;">Bolsas Disponibles</th>
                                        <th style="color:#fff;">Unidad Medida</th>
                                        <th style="color:#fff;">Precio Unitario</th>
                                        <th style="color:#fff;">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $contador = 1 @endphp
                                    <!-- Mostrar insumos activos -->
                                    @foreach ($insumos as $insumo)
                                    @if ($insumo->activo)
                                    <tr>
                                        <td>{{ $contador }}</td>
                                        <td>
                                            @if ($insumo->imagen)
                                            <img src="{{ asset($insumo->imagen) }}" alt="Imagen del insumo" width="25">
                                            @else
                                            Sin imagen
                                            @endif
                                        </td>
                                        <td>{{ $insumo->nombre }}</td>
                                        <td>
                                            <span class="badge badge-success">Activo</span>
                                        </td>
                                        <td>{{ $insumo->cantidad_disponible }}</td>
                                        <td>{{ round($insumo->cantidad_disponible/3) }}</td>

                                        <td>{{ $insumo->unidad_medida }}</td>
                                        <td>{{ number_format($insumo->precio_unitario, 0, '.','.') }}</td>


                                        <td>
                                            <form action="{{ route('insumo.destroy', $insumo->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('insumo.show', $insumo->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                <a class="btn btn-sm btn-success" href="{{ route('insumo.edit', $insumo->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                @if ($insumo['activo'] == 1)
                                                <button type="submit" class="btn btn-sm btn-info" onclick="confirmDesactivateInsumo(event)">
                                                    <i class="fa fa-fw fa-toggle-on"></i>
                                                </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @php $contador++ @endphp
                                    @endif
                                    @endforeach
                                    <!-- Mostrar insumos inactivos -->
                                    @foreach ($insumos as $insumo)
                                    @if (!$insumo->activo)
                                    <tr>
                                        <td>{{ $contador }}</td>
                                        <td>
                                            @if ($insumo->imagen)
                                            <img src="{{ asset($insumo->imagen) }}" alt="Imagen del insumo" width="25">
                                            @else
                                            Sin imagen
                                            @endif
                                        </td>
                                        <td>{{ $insumo->nombre }}</td>
                                        <td>
                                            <span class="badge badge-danger">Inactivo</span>
                                        </td>
                                        <td>{{ $insumo->cantidad_disponible }}</td>
                                        <td>{{ round($insumo->cantidad_disponible/3) }}</td>

                                        <td>{{ $insumo->unidad_medida }}</td>
                                        <td>{{ number_format($insumo->precio_unitario, 0, '.','.') }}</td>


                                        <td>
                                            <form action="{{ route('insumo.destroy', $insumo->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('insumo.show', $insumo->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                <a class="btn btn-sm btn-success" href="{{ route('insumo.edit', $insumo->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                @if ($insumo->activo == 0)
                                                <button type="submit" class="btn btn-sm btn-info" onclick="confirmDesactivateInsumo(event)">
                                                    <i class="fa fa-fw fa-toggle-off"></i>
                                                </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @php $contador++ @endphp
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function confirmDesactivateInsumo(event) {
        event.preventDefault();
        var form = $(event.target).closest('form');
        Swal.fire({
            icon: 'warning',
            title: '¿Estás seguro?',
            text: 'Esta acción desactivará la categoría',
            showCancelButton: true,
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function confirmActivateInsumo(event) {
        event.preventDefault();
        var form = $(event.target).closest('form');
        Swal.fire({
            icon: 'warning',
            title: '¿Estás seguro?',
            text: 'Esta acción activará la categoría',
            showCancelButton: true,
            confirmButtonText: 'Sí, activar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
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