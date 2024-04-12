@extends('layouts.app')

@section('content')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</head>
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Roles y Permisos</h3>
    </div>
    <div class="section-body">
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
                            <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>
                        </div>



                        <table class="table table-striped table-bordered" style="width:100%" id="example">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">No</th>
                                <th style="color:#fff;">Rol</th>
                                <th style="color:#fff;">Estado</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @php $contador = 1 @endphp
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $contador }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->estado)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>


                                        <a class="btn btn-sm btn-primary" href="{{ route('roles.show', $role->id) }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>

                                        @if (Session::has('sweet-alert'))
                                        <script>
                                            Swal.fire({
                                                icon: '{{ Session::get("sweet-alert.type") }}',
                                                title: '{{ Session::get("sweet-alert.title") }}',
                                                text: '{{ Session::get("sweet-alert.text") }}',
                                                showConfirmButton: false,
                                                timer: 3000
                                            });
                                        </script>
                                        @endif

                                        @if ($role->name !== 'administrador' && $role->name !== 'cliente')
                                        @if ($role->estado)
                                        {!! Form::open([
                                        'method' => 'PUT',
                                        'route' => ['roles.deactivate', $role->id],
                                        'style' => 'display:inline',
                                        'onsubmit' => 'return confirmDeactivateRole(event)'
                                        ]) !!}
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="fa fa-fw fa-toggle-on"></i>
                                        </button>
                                        {!! Form::close() !!}

                                        <script>
                                            function confirmDeactivateRole(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: '¿Estás seguro?',
                                                    text: 'Esta acción desactivará el rol',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Sí, desactivar',
                                                    cancelButtonText: 'Cancelar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        event.target.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                        @else
                                        {!! Form::open([
                                        'method' => 'PUT',
                                        'route' => ['roles.activate', $role->id],
                                        'style' => 'display:inline',
                                        'onsubmit' => 'return confirmActivateRole(event)'
                                        ]) !!}
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="fa fa-fw fa-toggle-off"></i> 
                                        </button>
                                        {!! Form::close() !!}

                                        <script>
                                            function confirmActivateRole(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: '¿Estás seguro?',
                                                    text: 'Esta acción activará el rol',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Sí, activar',
                                                    cancelButtonText: 'Cancelar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        event.target.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                        @endif
                                        @endif



                                        @if ($role->name !== 'administrador' && $role->name !== 'cliente')
                                        <a class="btn btn-sm btn-success" href="{{ route('roles.edit', $role->id) }}">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                        @endif
                                        @if ($role->name !== 'administrador' && $role->name !== 'cliente')
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['roles.destroy', $role->id],
                                        'style' => 'display:inline',
                                        'class' => 'delete-form',
                                        ]) !!}
                                        @if ($role->users->isNotEmpty() && $role->name !== 'administrador' && $role->name !== 'cliente')
                                        
                    
                                        @else
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)"><i class="fa fa-fw fa-trash"></i></button>
                                        @endif
                                        {!! Form::close() !!}
                                        @endif


                                    </td>
                                </tr>
                                @php $contador++ @endphp
                                @endforeach
                            </tbody>

                        </table>








                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el rol. No podrás deshacer esta acción.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('.delete-form').submit();
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