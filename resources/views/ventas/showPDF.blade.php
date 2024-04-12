<div class="section-header">
    <h3 class="page__heading">Informe de Ventas</h3>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Detalles del Ventas</h1>





                                <p><strong>Usuario:</strong> {{ $pedido->users->name }}</p>
                                @if (!empty($pedido->Telefono))
                                    <p><strong>Teléfono:</strong> {{ $pedido->Telefono }}</p>
                                @endif
                                <p><strong>Estado:</strong> {{ $pedido->Estado }}</p>
                                <p><strong>Fecha:</strong> {{ $pedido->Fecha }}</p>
                                <p><strong>Total:</strong> {{ number_format($pedido->Total, 0, ',', '.') }}</p>

                                <h2>Detalles del Productos</h2>

                                <table class="table">
                                    @if (!empty($pedido->Descripcion))
                                        <p style="font-size: 1.5em"><strong>descripción:</strong>
                                            {{ $pedido->Descripcion }}</p>
                                    @endif
                                    @if ($pedido->Direcion)
                                        <p style="font-size: 1.5em"><strong style="font-size: 1em">direccion:</strong>
                                            {{ $pedido->Direcion }}</p>
                                    @elseif ($pedido->users->direccion)
                                        <p style="font-size: 1.5em"><strong style="font-size: 1em">direccion:</strong>
                                            {{ $pedido->users->direccion }}</p>
                                    @endif
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio unitario</th>
                                            <th>sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalles_pedidos as $detalle)
                                            <tr>
                                                <td>{{ $detalle->Nombre }}</td>

                                                {{-- <td>{{ $detalle->Prductos->nombre }}</td> --}}

                                                <td>{{ $detalle->cantidad }}</td>

                                                <td>{{ $detalle->precio_unitario }}</td>
                                                <td>
                                                    {{ number_format($detalle->cantidad * $detalle->precio_unitario, 0, ',', '.') }}

                                                </td>

                                            </tr>
                                        @endforeach
                                        <?php $per = ''; ?>
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
                                                    <td>{{ number_format($lastSubtotal, 0, ',', '.') }}</td>
                                                    <!-- Print the last Subtotal for the current $per -->
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                           <?php $per = null; ?>
@foreach ($personaliza as $personalizas)
    @if ($personalizas->nombre !== $per)
        <?php
        $per = $personalizas->nombre;
        $i = null; // Inicializar $i para cada nuevo grupo de nombre
        ?>
        <div class="">
            <p>Nombre: {{ $personalizas->nombre }}</p>
            <ul>
               

                @foreach ($personaliza as $q)
                @if ($q->nombre === $per)
                <li>
                    Insumo: {{ $q->datos }}
                </li>
                @endif

        @endforeach
            </ul>
            @foreach ($personaliza as $q)
                @if ($q->nombre === $per && $q->Descripción !== $i)
                    <?php $i = $q->Descripción; ?>
                    <p><strong>Descripción:</strong> <span class="modal-descripcion">{{ $q->Descripción }}</span></p>
                @endif
            @endforeach

            <!-- Agrega aquí más detalles del producto si es necesario -->
        </div>
    @endif
@endforeach



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Global styles */
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Header styles */
    .section-header {
        background-color: #f0f0f0;
        padding: 10px;
        text-align: center;
    }

    .page__heading {
        margin: 0;
        padding: 10px;
        font-size: 24px;
        color: #333;
    }

    /* Card styles */
    .card {
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
        background-color: #fff;
    }

    .card-body {
        padding: 20px;
    }

    /* Sales details styles */
    .sales-details {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
    }

    .sales-details h1 {
        margin-top: 0;
        color: #333;
        font-size: 24px;
    }

    .sales-details p {
        margin: 5px 0;
        color: #666;
    }

    /* Table styles */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }

    .table th {
        background-color: #f0f0f0;
        font-weight: bold;
        color: #333;
    }
</style>
