@extends('layouts.app')

@section('title')
Categorías
@endsection

@section('content')
<section class="section">
    <div class="section-header">

        <h3 class="page__heading">Categorias</h3>


    </div>
    <div class="section-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Revise los campos¡</strong>
        </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div style="margin-bottom: 20px;">
                            <a class="btn btn-warning" href="{{ route('categoria.create') }}">Nuevo</a>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef" class="thead">
                                    <tr>
                                        <th style="color:#fff;">No</th>
                                        <th style="color:#fff;">Imagen</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">Descripción</th>
                                        <th style="color:#fff;">Estado</th>
                                        <th style="color:#fff;">Opciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $contador = 1 @endphp
                                    <!-- Mostrar categorías activas -->
                                    @foreach ($categoria as $categorium)
                                    @if ($categorium->activo)
                                    <tr>
                                        <td>{{ $contador }}</td>
                                        <td>
                                            @if ($categorium->imagen)
                                            <img src="{{ asset($categorium->imagen) }}" alt="Imagen del categoria" width="25">
                                            @else
                                            Sin imagen
                                            @endif
                                        </td>

                                        <td class="">{{ $categorium->nombre }}</td>
                                        <td>{{ $categorium->descripcion }}</td>
                                        <td> <span class="badge badge-success">Activo</span>
                                        </td>

                                        <td>
                                            <form action="{{ route('categoria.destroy', $categorium->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('categoria.show', $categorium->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('categoria.edit', $categorium->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                @if ($categorium->activo)
                                                <button type="submit" class="btn btn-sm btn-info" onclick="confirmDesactivateCategoria(event)"> <i class="fa fa-fw fa-toggle-on"></i> </button>
                                                @else
                                                <button type="submit" class="btn btn-sm btn-info" onclick="confirmActivateCategoria(event)"> <i class="fa fa-fw fa-toggle-off"></i> </button>
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                    @php $contador++ @endphp
                                    @endif
                                    @endforeach

                                    <!-- Mostrar categorías inactivas -->
                                    @foreach ($categoria as $categorium)
                                    @if (!$categorium->activo)
                                    <tr>
                                        <td>{{ $contador }}</td>
                                        <td>
                                            @if ($categorium->imagen)
                                            <img src="{{ asset($categorium->imagen) }}" alt="Imagen del categoria" width="25">
                                            @else
                                            Sin imagen
                                            @endif
                                        </td>

                                        <td class="">{{ $categorium->nombre }}</td>
                                        <td>{{ $categorium->descripcion }}</td>
                                        <td> <span class="badge badge-danger">Inactivo</span> </td>
                                        <td>
                                            <form action="{{ route('categoria.destroy', $categorium->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('categoria.show', $categorium->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('categoria.edit', $categorium->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                @if ($categorium->activo)
                                                <button type="submit" class="btn btn-sm btn-info" onclick="confirmDesactivateCategoria(event)"> <i class="fa fa-fw fa-toggle-on"></i> </button>
                                                @else
                                                <button type="submit" class="btn btn-sm btn-info" onclick="confirmActivateCategoria(event)"> <i class="fa fa-fw fa-toggle-off"></i> </button>
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
    function confirmDesactivateCategoria(event) {
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

    function confirmActivateCategoria(event) {
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