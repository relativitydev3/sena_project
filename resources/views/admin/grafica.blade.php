@extends('layouts.app')
@section('title', 'ventas')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">Top 3 Productos Más Vendidos</h2>

                            <div class="table-responsive">
                                <table class="table table-striped">
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
                            </div>

                            <!-- Contenedor de la gráfica centrado -->
                            <div class="chart-container mt-4" style="max-width: 600px; margin: 0 auto;">
                                <canvas id="graficaTopProductos"></canvas>
                            </div>
                        </div>
                    </div>

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

                            // Configurar y mostrar la gráfica en formato circular (doughnut)
                            var ctx = document.getElementById("graficaTopProductos").getContext("2d");
                            new Chart(ctx, {
                                type: "doughnut", // Cambiamos el tipo de gráfica a "doughnut"
                                data: {
                                    labels: nombres,
                                    datasets: [{
                                        label: "Cantidad Vendida",
                                        data: cantidades,
                                        backgroundColor: ["rgba(75, 192, 192, 0.6)", "rgba(255, 99, 132, 0.6)", "rgba(255, 205, 86, 0.6)"], // Colores para las secciones
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    // Opciones adicionales de la gráfica
                                }
                            });
                        });
                    </script>








                    <div class="card">
                        <div class="card-body">
                            <h1>Cantidad Vendida por Año</h1>
                            <div class="row">
                                <div class="col-lg-6">
                                    <form id="formBuscar" class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="inputAnio" class="sr-only">Año</label>
                                            <select class="form-control" id="inputAnio">
                                                <!-- Opciones de años, puedes generar estas opciones desde tu backend si es necesario -->
                                                <option value="2026">2026</option>
                                                <option value="2025">2025</option>
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <!-- Agrega más años según tus necesidades -->
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <canvas id="graficaVentas"></canvas>
                            </div>
                        </div>
                    </div>




            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- informe --}}


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los datos de cantidadPorMes desde el backend
        var cantidadPorMes = {!! json_encode($cantidadPorMes) !!};

        // Obtener el año y mes actual
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1;

        // Crear un array con los meses y años del año actual
        var meses = [];
        var labels = [];
        for (var month = 1; month <= currentMonth; month++) {
            meses.push(month);
            labels.push(currentYear + '-' + month);
        }

        // Rellenar las cantidades vendidas correspondientes
        var cantidades = [];
        for (var i = 0; i < labels.length; i++) {
            var cantidad = 0;
            for (var j = 0; j < cantidadPorMes.length; j++) {
                if (cantidadPorMes[j].year === currentYear && cantidadPorMes[j].month === meses[i]) {
                    cantidad = cantidadPorMes[j].total_cantidad;
                    break;
                }
            }
            cantidades.push(cantidad);
        }

        // Configurar y mostrar la gráfica inicial
        var ctx = document.getElementById("graficaVentas").getContext("2d");
        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
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

        // Manejar la búsqueda por año
        var formBuscar = document.getElementById("formBuscar");
        var inputAnio = document.getElementById("inputAnio");

        formBuscar.addEventListener("submit", function(event) {
            event.preventDefault();

            var anio = inputAnio.value;

            // Obtener los meses y las cantidades vendidas del año especificado
            var mesesBuscar = [];
            var labelsBuscar = [];
            var cantidadesBuscar = [];
            for (var month = 1; month <= 12; month++) {
                mesesBuscar.push(month);
                labelsBuscar.push(anio + '-' + month);

                var cantidadBuscar = 0;
                for (var j = 0; j < cantidadPorMes.length; j++) {
                    if (cantidadPorMes[j].year === parseInt(anio) && cantidadPorMes[j].month ===
                        month) {
                        cantidadBuscar = cantidadPorMes[j].total_cantidad;
                        break;
                    }
                }
                cantidadesBuscar.push(cantidadBuscar);
            }

            // Actualizar la gráfica con los datos del año buscado
            chart.data.labels = labelsBuscar;
            chart.data.datasets[0].data = cantidadesBuscar;
            chart.update();
        });
    });
</script>
@endsection
