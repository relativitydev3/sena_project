@extends('layouts.app')

@section('content')
@section('title', 'Pedidos')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="">
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


                <h3 class="page__heading ml-3 mb-0">Pedidos</h3>
            </div>
        </div>

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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" style="margin-bottom: 20px"
                            href="{{ url('pedidos/create') }}">Nuevo</a>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">No</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Telefono</th>
                                <th style="color:#fff;">Direcion</th>
                                <th style="color:#fff;">Estado</th>
                                <th style="color:#fff;">Fecha</th>
                                <th style="color:#fff;">Total</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            @php $Numero = 1 @endphp

                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    @if ($pedido->Estado == 'En_proceso')
                                        <tr>
                                            <td>{{ $Numero }}</td>

                                            <td>{{ $pedido->users ? $pedido->users->name : 'Null' }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->telefono : 'Null' }}</td>
                                            <td>
                                                @if ($pedido->Direcion)
                                                    {{ $pedido->Direcion }}
                                                @else
                                                    {{ $pedido->users->direccion }}
                                                @endif
                                            </td>



                                            <td>
                                                <form action="{{ route('pedidos.updateEstado', $pedido->id) }}"
                                                    method="POST" id="form-estado-{{ $pedido->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="Estado" value="{{ $pedido->Estado }}">
                                                    <button type="button"
                                                        class="btn btn-sm btn-{{ $pedido->Estado == 'En_proceso' ? 'primary' : 'success' }}"
                                                        onclick="cambiarEstado({{ $pedido->id }}) ">
                                                        En proceso
                                                    </button>
                                                </form>
                                            </td>
                                            {{-- <td>{{ $pedido->Fecha }}</td> --}}
                                            <td>{{ substr($pedido->created_at, 11, 5) }}</td>


                                            <td> {{ number_format($pedido->Total, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <div class="text-center" style="display: flex">

                                                    <form action="{{ url('pedidos/' . $pedido->id) }}" method="post">
                                                        <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa fa-fw fa-eye"></i></a></a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ url('pedidos/' . $pedido->id . '/edit') }}">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                        {{-- <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion({{ $pedido->id }})">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </button> --}}


                                                    </form>
                                                    <form action="{{ route('pedidos.updateEstadoo', $pedido->id) }}"
                                                        method="POST" id="form-estadoo-{{ $pedido->id }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Add the input element for 'Estado' -->
                                                        <input type="hidden" name="Estadoo"
                                                            value="{{ $pedido->estado }}">

                                                        <!-- Botón para abrir el modal -->

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#motivoModal">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </form>
                                                    <!-- Botón para abrir el modal -->

                                                    <!-- Modal para el motivo de cancelación -->
                                                    <div class="modal fade" id="motivoModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Motivo de cancelación</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Cerrar">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Formulario dentro del modal -->
                                                                    <form id="modalForm"
                                                                        action="{{ route('pedidos.updateEstadoo', $pedido->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <!-- Campo de entrada para el motivo de cancelación -->
                                                                        <div class="form-group">
                                                                            <label for="motivoCancelacion">Motivo de
                                                                                cancelación</label>
                                                                            <input type="text" class="form-control"
                                                                                id="motivoCancelacion"
                                                                                name="motivo_cancelacion"
                                                                                placeholder="Ingrese el motivo de cancelación"
                                                                                required>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- Botón para enviar el motivo al controlador -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        onclick="enviarMotivo()">Enviar</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function enviarMotivo() {
                                                            // Envía el formulario dentro del modal
                                                            $('#modalForm').submit();

                                                            // Restablece el valor del campo de motivo de cancelación a una cadena vacía
                                                            $('#motivoCancelacion').val('');

                                                            // Cierra el modal
                                                            $('#motivoModal').modal('hide');
                                                        }
                                                    </script>

                                                    {{-- <form id="form-eliminar-{{ $pedido->id }}" action="{{ url('pedidos/' . $pedido->id) }}" method="post" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form> --}}


                                                </div>
                                            </td>
                                        </tr>
                                        @php $Numero++ @endphp
                                    @endif
                                @endforeach
                                @foreach ($pedidos as $pedido)
                                    @if ($pedido->Estado == 'Terminados')
                                        <tr>
                                            <td>{{ $Numero }}</td>

                                            <td>{{ $pedido->users ? $pedido->users->name : 'Null' }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->telefono : 'Null' }}</td>
                                            <td>
                                                @if ($pedido->Direcion)
                                                    {{ $pedido->Direcion }}
                                                @else
                                                    {{ $pedido->users->direccion }}
                                                @endif
                                            </td>



                                            <td>
                                                <form action="{{ route('pedidos.updateEstado', $pedido->id) }}"
                                                    method="POST" id="form-estado-{{ $pedido->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="Estado"
                                                        value="{{ $pedido->Estado }}">
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        onclick="cambiarEstado({{ $pedido->id }}) ">
                                                        Terminado
                                                    </button>
                                                </form>
                                            </td>
                                            {{-- <td>{{ $pedido->Fecha }}</td> --}}
                                            <td>{{ substr($pedido->created_at, 11, 5) }}</td>


                                            <td> {{ number_format($pedido->Total, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <div class="text-center" style="display: flex">

                                                    <form action="{{ url('pedidos/' . $pedido->id) }}"
                                                        method="post">
                                                        <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa fa-fw fa-eye"></i></a></a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ url('pedidos/' . $pedido->id . '/edit') }}">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                    </form>
                                                    <form action="{{ route('pedidos.updateEstadoo', $pedido->id) }}"
                                                        method="POST" id="form-estadoo-{{ $pedido->id }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Add the input element for 'Estado' -->
                                                        <input type="hidden" name="Estadoo"
                                                            value="{{ $pedido->estado }}">
                                                        <!-- Botón para abrir el modal -->
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#motivoModal">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>

                                                    </form>
                                                    <!-- Modal para el motivo de cancelación -->
                                                    <div class="modal fade" id="motivoModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Motivo de cancelación</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Cerrar">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Formulario dentro del modal -->
                                                                    <form id="modalForm"
                                                                        action="{{ route('pedidos.updateEstadoo', $pedido->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <!-- Campo de entrada para el motivo de cancelación -->
                                                                        <div class="form-group">
                                                                            <label for="motivoCancelacion">Motivo de
                                                                                cancelación</label>
                                                                            <input type="text" class="form-control"
                                                                                id="motivoCancelacion"
                                                                                name="motivo_cancelacion"
                                                                                placeholder="Ingrese el motivo de cancelación"
                                                                                required>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- Botón para enviar el motivo al controlador -->
                                                                    <button type="button" class="btn btn-primary"
                                                                        onclick="enviarMotivo()">Enviar</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function enviarMotivo() {
                                                            // Envía el formulario dentro del modal
                                                            $('#modalForm').submit();

                                                            // Restablece el valor del campo de motivo de cancelación a una cadena vacía
                                                            $('#motivoCancelacion').val('');

                                                            // Cierra el modal
                                                            $('#motivoModal').modal('hide');
                                                        }
                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $Numero++ @endphp
                                    @endif
                                @endforeach


                                @foreach ($pedidos as $pedido)
                                    @if ($pedido->Estado == 'Cancelado')
                                        <tr>
                                            <td>{{ $Numero }}</td>

                                            <td>{{ $pedido->users ? $pedido->users->name : 'Null' }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->telefono : 'Null' }}</td>
                                            <td>
                                                @if ($pedido->Direcion)
                                                    {{ $pedido->Direcion }}
                                                @else
                                                    {{ $pedido->users->direccion }}
                                                @endif
                                            </td>



                                            <td>
                                                <form action="{{ route('pedidos.updateEstado', $pedido->id) }}"
                                                    method="POST" id="form-estado-{{ $pedido->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="Estado"
                                                        value="{{ $pedido->Estado }}">
                                                    <div
                                                        style="background: #f8473e;color: #fff;border-radius: 5px;text-align: center;width: 95%;height: 2.2em;display: flex;align-items: center;
                                                        justify-content: center">

                                                        {{ $pedido->Estado }}
                                                    </div>

                                                </form>
                                            </td>
                                            <td>{{ $pedido->Fecha }}</td>
                                            <td> {{ number_format($pedido->Total, 0, ',', '.') }}</td>
                                            <td style="display: flex">
                                                <div class="">
                                                    <form action="{{ url('pedidos/' . $pedido->id) }}"
                                                        method="post">
                                                        <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa fa-fw fa-eye"></i></a>
                                                        <!-- Botón para mostrar el motivo de cancelación en un modal -->
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#motivoCancelacionModal{{ $pedido->id }}">
                                                            <i class="fa fa-fw fa-info-circle"></i>
                                                        </button>

                                                    </form>
                                                </div>
                                            </td>
                                            <!-- Modal para mostrar el motivo de cancelación -->
                                            <div class="modal fade" id="motivoCancelacionModal{{ $pedido->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="motivoCancelacionModalLabel{{ $pedido->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="motivoCancelacionModalLabel{{ $pedido->id }}">
                                                                Motivo de Cancelación</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Cerrar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Aquí muestra el motivo de cancelación del pedido -->
                                                            Motivo de cancelación: {{ $pedido->motivoCancelacion }}
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                        @php $Numero++ @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


</form>
{{-- <script>
    // Cuando se haga clic en el botón "Enviar" del modal
    $('#enviarMotivo').on('click', function() {
        $('#modalForm').submit(); // Envía el formulario dentro del modal

        // Restablece el valor del campo de motivo de cancelación a una cadena vacía
        $('#motivoCancelacion').val('');
    });
</script> --}}
<script>
    function confirmarEliminacion(pedidoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el pedido.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, enviar el formulario
                var form = document.getElementById('form-eliminar-' + pedidoId);
                form.submit();
            }
        });
    }
</script>

<script>
    function cambiarEstado(pedidoId) {
        var form = document.getElementById('form-estado-' + pedidoId);
        var estadoInput = form.querySelector('input[name="Estado"]');
        var estado = estadoInput.value;

        // Cambiar el estado
        if (estado === 'En_proceso') {
            estado = 'Terminados';
        } else if (estado === 'Terminados') {
            estado = 'Finalizado';
        }
        estadoInput.value = estado;

        // Cambiar el color del botón y mostrar el mensaje
        var button = form.querySelector('button');
        if (estado === 'En_proceso') {
            button.classList.remove('btn-success');
            button.classList.add('btn-primary');
            button.innerText = 'En proceso';
        } else if (estado === 'En_proceso') {
            button.classList.remove('btn-primary');
            button.classList.add('btn-success');
            button.innerText = 'Finalizado';
        }

        // Enviar el formulario
        form.submit();
    }

    function cambiarEstadoq(pedidoId) {
        Swal.fire({
            title: 'Confirmar cambio de estado',
            text: '¿Estás seguro de que deseas cambiar el estado?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cambiar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('form-estado-' + pedidoId);
                var estadoInput = form.querySelector('input[name="Estado"]');
                var estado = estadoInput.value;

                // Cambiar el estado
                if (estado === 'En_proceso') {
                    estado = 'Cancelado';
                } else if (estado === 'Terminados') {
                    estado = 'Finalizado';
                }











                estadoInput.value = estado;

                // Cambiar el color del botón y mostrar el mensaje
                var button = form.querySelector('button');
                if (estado === 'En_proceso') {
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                    button.innerText = 'En proceso';
                } else {
                    button.classList.remove('btn-primary');
                    button.classList.add('btn-success');
                    button.innerText = 'Finalizado';
                }

                // Enviar el formulario
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
