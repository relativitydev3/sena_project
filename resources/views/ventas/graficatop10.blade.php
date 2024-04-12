@extends('layouts.app')
@section('title', 'ventas')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ventas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Top 3 Productos Más Vendidos</h1>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Producto</th>
                                        <th>Cantidad Vendida</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($topProductos as $index => $producto)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->total_vendido }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div>
                                <canvas id="graficaTopProductos"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener los datos del topProductos desde el backend
            var topProductos = {!! json_encode($topProductos) !!};
    
            // Obtener solo los 3 primeros productos
            topProductos = topProductos.slice(0, 3);
    
            // Obtener los nombres y cantidades vendidas de los productos
            var nombres = topProductos.map(function(producto) {
                return producto.nombre;
            });
            var cantidades = topProductos.map(function(producto) {
                return producto.total_vendido;
            });
    
            // Configurar y mostrar la gráfica
            var ctx = document.getElementById("graficaTopProductos").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: nombres,
                    datasets: [{
                        label: "Cantidad Vendida",
                        data: cantidades,
                        backgroundColor: "rgba(75, 192, 192, 0.6)",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        });
    </script>
@endsection
