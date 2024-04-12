@extends('layouts.app')

@section('content')
@section('title', 'Ventas')


<section class="section">


    <div class="section-header">
        <h3 class="page__heading">Ventas</h3>
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
                    {{-- <a class="btn btn-sm btn-success" href="{{ route('ventas.graficatop10') }}"><i class="fa fa-fw fa-edit"></i> Top 10</a> --}}
                    <div class="card-body">


                        {{-- <a class="btn btn-sm btn-success" href="{{ route('ventas.graficatop10') }}"><i class="fa fa-fw fa-edit"></i>Top 10</a>
                        <a class="btn btn-sm btn-success" href="{{ route('ventas.informe') }}"><i class="fa fa-fw fa-edit"></i>grafica</a>

                         --}}
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
                                @foreach ($ventas as $venta)

                                    @if ($venta->Estado == 'Finalizado')
                                        <tr>
                                            <td>{{ $Numero }}</td>

                                            <td>{{ $venta->users->name }}</td>
                                            <td>{{ $venta->users->telefono }}</td>
                                            <td>
                                                @if ($venta->Direcion)
                                                    {{ $venta->Direcion }}
                                                @else
                                                    {{ $venta->users->direccion }}
                                                @endif
                                            </td>
                                            <td>{{ $venta->Estado }}</td>
                                            {{-- <td>{{ $venta->Fecha }}</td> --}}
                                            <td>{{ substr($venta->created_at, 11, 5) }}</td>

                                            <td>{{ $venta->Total }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('ventas.show', $venta->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i></a>
                                            </td>
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
