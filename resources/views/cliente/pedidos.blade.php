@extends('layouts.auth_app')
@section('title')
    Pedidos
@endsection
@section('content')

    <body>



        <div class="row" style="padding-top: 60px;">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1 style="margin-top: 1em; text-align: center;">Mis Pedidos</h1>


                    <div class="container">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12">
                                {{-- <h1>Lista de Pedidos</h1> --}}

                                @if (count($pedidos) > 0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Dirección</th>
                                                <th>Estado</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedidos as $pedido)
                                                @if ($pedido->Estado == 'Terminados')
                                                    <tr>

                                                        <td>{{ $pedido->Fecha }}</td>
                                                        <td> {{ substr($pedido->created_at, 11, 5) }}</td>


                                                        <td>
                                                            @if ($pedido->Direcion)
                                                                {{ $pedido->Direcion }}
                                                            @else
                                                                {{ $pedido->users->direccion }}
                                                            @endif
                                                        </td>
                                                        <td style="color:#000;">
                                                            @if ($pedido->Estado == 'Terminados')
                                                                <div
                                                                    style="background: rgba(17, 192, 1, 0.753);border-radius:1em ; display:flex;
                                    align-content: center;justify-content: center;font-size: 1.1em;width: 6em;">
                                                                    {{ $pedido->Estado }}
                                                                </div>
                                                            @endif

                                                        </td>
                                                        <td> {{ number_format($pedido->Total, 0, ',', '.') }}

                                                        </td>
                                                        <td>
                                                            <!-- Enlace para ver el detalle del pedido -->
                                                            <a href="{{ route('Detalle', $pedido->id) }}"
                                                                class="btn btn-info">Ver
                                                                Detalle</a>

                                                        </td>



                                                    </tr>
                                                @endif
                                            @endforeach
                                            @foreach ($pedidos as $pedido)
                                                @if ($pedido->Estado == 'En_proceso')
                                                    <tr>

                                                        <td>{{ $pedido->Fecha }}</td>
                                                        <td> {{ substr($pedido->created_at, 11, 5) }}</td>


                                                        <td>
                                                            @if ($pedido->Direcion)
                                                                {{ $pedido->Direcion }}
                                                            @else
                                                                {{ $pedido->users->direccion }}
                                                            @endif
                                                        </td>
                                                        <td style="color:#000;">
                                                            @if ($pedido->Estado == 'En_proceso')
                                                                <div
                                                                    style="background: rgba(52, 120, 187, 0.753);border-radius:1em ; display:flex;
                                        align-content: center;justify-content: center;font-size: 1.1em;width: 6em;">
                                                                    En proceso
                                                                </div>
                                                            @endif

                                                        </td>
                                                        <td> {{ number_format($pedido->Total, 0, ',', '.') }}

                                                        </td>
                                                        <td>
                                                            <!-- Enlace para ver el detalle del pedido -->
                                                            <a href="{{ route('Detalle', $pedido->id) }}"
                                                                class="btn btn-info">Ver
                                                                Detalle</a>
                                                        </td>



                                                    </tr>
                                                @endif
                                            @endforeach
                                            @foreach ($pedidos as $pedido)
                                                @if ($pedido->Estado == 'Cancelado')
                                                    <tr>

                                                        <td>{{ $pedido->Fecha }}</td>
                                                        <td> {{ substr($pedido->created_at, 11, 5) }}</td>


                                                        <td>
                                                            @if ($pedido->Direcion)
                                                                {{ $pedido->Direcion }}
                                                            @else
                                                                {{ $pedido->users->direccion }}
                                                            @endif
                                                        </td>
                                                        <td style="color:#000;">
                                                            @if ($pedido->Estado == 'Cancelado')
                                                                <div
                                                                    style="background: rgba(175, 0, 0, 0.753);border-radius:1em ; display:flex;
                                                                            align-content: center;justify-content: center;font-size: 1.1em;width: 6em;">
                                                                    {{ $pedido->Estado }}
                                                                </div>
                                                            @endif

                                                        </td>
                                                        <td> {{ number_format($pedido->Total, 0, ',', '.') }}

                                                        </td>
                                                        <td style="">
                                                            <!-- Enlace para ver el detalle del pedido -->
                                                            <a href="{{ route('Detalle', $pedido->id) }}"
                                                                class="btn btn-info">Ver
                                                                Detalle</a>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                style="padding: 0.2em;" data-toggle="modal"
                                                                data-target="#motivoCancelacionModal{{ $pedido->id }}">
                                                                <i class="fa fa-fw fa-info-circle"></i>
                                                            </button>
                                                        </td>
                                                        <!-- Modal para mostrar el motivo de cancelación -->
                                                        <div class="modal fade"
                                                            id="motivoCancelacionModal{{ $pedido->id }}" tabindex="-1"
                                                            role="dialog"
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
                                                                    <div class="modal-body" style="display: flex;justify-content: left;">
                                                                        <!-- Aquí muestra el motivo de cancelación del pedido -->
                                                                        Motivo de cancelación:
                                                                        {{ $pedido->motivoCancelacion }}
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </tr>
                                                @endif
                                            @endforeach
                                            @foreach ($pedidos as $pedido)
                                                @if ($pedido->Estado == 'Finalizado')
                                                    <tr>

                                                        <td>{{ $pedido->Fecha }}</td>
                                                        <td> {{ substr($pedido->created_at, 11, 5) }}</td>


                                                        <td>
                                                            @if ($pedido->Direcion)
                                                                {{ $pedido->Direcion }}
                                                            @else
                                                                {{ $pedido->users->direccion }}
                                                            @endif
                                                        </td>
                                                        <td style="color:#000;">
                                                            @if ($pedido->Estado == 'Finalizado')
                                                                <div
                                                                    style="background: rgba(59, 226, 255, 0.904);border-radius:1em ; display:flex;
                                    align-content: center;justify-content: center;font-size: 1.1em;width: 6em;">
                                                                    Finalizado
                                                                </div>
                                                            @endif

                                                        </td>
                                                        <td> {{ number_format($pedido->Total, 0, ',', '.') }}

                                                        </td>
                                                        <td>
                                                            <!-- Enlace para ver el detalle del pedido -->
                                                            <a href="{{ route('Detalle', $pedido->id) }}"
                                                                class="btn btn-info">Ver
                                                                Detalle</a>
                                                        </td>



                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p style=" font-size: 16px; font-weight: bold;">No hay pedidos disponibles.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <div style="padding-top: 25%">

                    </div>
                    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>





    </body>


@endsection
