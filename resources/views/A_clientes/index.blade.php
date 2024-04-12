@extends('layouts.app')

@section('content')
<section class="section">
  <head>
    @include('sweetalert::alert')
  </head>
  <div class="section-header">
      <h3 class="page__heading">Clientes</h3>
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
                          <a class="btn btn-warning" href="{{ route('A_clientes.create') }}">Nuevo</a>        
                        </div>
                          

                        
                          <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">No</th>
                                <th style="color:#fff;">Documento</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Apellidos</th>
                                <th style="color:#fff;">Estado</th>
                                <th style="color:#fff;">Teléfono</th>
                                <th style="color:#fff;">Dirección</th>
                                <th style="color:#fff;">E-mail</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                {{-- Muestra primero los usuarios activos --}}
                                @php $contador = 1 @endphp
                                @foreach ($usuarios as $usuario)
                                    @foreach ($usuario->roles as $rol)
                                        @if ($rol->name === 'cliente' && $usuario->estado)
                                            <tr>
                                                <td>{{ $contador }}</td>
                                                <td>{{ $usuario->documento }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->apellidos }}</td>
                                                <td>
                                                    <span class="badge badge-success">Activo</span>
                                                </td>
                                                <td>{{ $usuario->telefono }}</td>
                                                <td>{{ $usuario->direccion }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="{{ route('A_clientes.show', $usuario->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('A_clientes.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['A_clientes.destroy', $usuario->id],
                                                        'style' => 'display:inline',
                                                        'onsubmit' => 'confirmDelete(event, this)',
                                                    ]) !!}
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @php $contador++ @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                        
                                {{-- Luego muestra los usuarios inactivos --}}
                                @foreach ($usuarios as $usuario)
                               
                                    @foreach ($usuario->roles as $rol)
                                        @if ($rol->name === 'cliente' && !$usuario->estado)
                                            <tr>
                                              <td>{{ $contador }}</td>
                                                <td>{{ $usuario->documento }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->apellidos }}</td>
                                                <td>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                </td>
                                                <td>{{ $usuario->telefono }}</td>
                                                <td>{{ $usuario->direccion }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="{{ route('A_clientes.show', $usuario->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('A_clientes.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    
                                                    
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['A_clientes.destroy', $usuario->id],
                                                        'style' => 'display:inline',
                                                        'onsubmit' => 'confirmDelete(event, this)',
                                                    ]) !!}
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    {!! Form::close() !!}
                                                
                                                </td>
                                            </tr>
                                            @php $contador++ @endphp
                                        @endif
                                    @endforeach
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
<script src="{{ asset('js/es_datatables.js') }}"></script>
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
  function confirmDelete(event, form) {
    event.preventDefault();

    Swal.fire({
      title: '¿Estás seguro?',
      text: 'Esta acción eliminará al cliente. No podrás deshacer esta acción.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  }
</script>
@endsection