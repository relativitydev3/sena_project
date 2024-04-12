@extends('layouts.app')

@section('content')

    <head>
        <script src="{{ asset('js/translations/es.json') }}"></script>


        @include('sweetalert::alert')


    </head>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
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
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif


                            
                            <div style="margin-bottom: 20px;">
                                <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>
                            </div>
                            

                            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">No</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Apellidos</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">E-mail</th>
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php $contador = 1 @endphp
                                    @foreach ($usuarios as $usuario)
                                        @if ($usuario->name ==\Illuminate\Support\Facades\Auth::user()->name)

                                        @else ($usuario->estado)
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->apellidos }}</td>
                                                <td>
                                                    <span class="badge badge-success">Activo</span>
                                                </td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    @if (!empty($usuario->getRoleNames()))
                                                        @foreach ($usuario->getRoleNames() as $rolNombre)
                                                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span>
                                                            </h5>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('usuarios.show', $usuario->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('usuarios.edit', $usuario->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['usuarios.destroy', $usuario->id],
                                                        'style' => 'display:inline',
                                                        'class' => 'delete-form',
                                                    ]) !!}
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete(this)"><i
                                                            class="fa fa-fw fa-trash"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @php $contador++ @endphp

                                        @endif
                                    @endforeach

                                    <!-- Luego, listar usuarios inactivos -->
                                    @foreach ($usuarios as $usuario)
                                        @if (!$usuario->estado)
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->apellidos }}</td>
                                                <td>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                </td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    @if (!empty($usuario->getRoleNames()))
                                                        @foreach ($usuario->getRoleNames() as $rolNombre)
                                                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span>
                                                            </h5>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('usuarios.show', $usuario->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('usuarios.edit', $usuario->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['usuarios.destroy', $usuario->id],
                                                        'style' => 'display:inline',
                                                        'class' => 'delete-form',
                                                    ]) !!}
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete(this)"><i
                                                            class="fa fa-fw fa-trash"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @php $contador++ @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará al usuario. No podrás deshacer esta acción.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parentNode.submit();
                }
            });
        }
    </script>

@endsection
