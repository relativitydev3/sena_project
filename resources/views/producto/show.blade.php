@extends('layouts.app')

@section('title')
Mostrar Producto
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h3 class="page__heading ml-3 mb-0">Detalle de Producto</h3>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <img src="{{ asset($producto->imagen) }}" class="img-thumbnail" alt="Imagen del producto" width="115px">
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $producto->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $producto->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            @if ($producto['activo'] == 1)
                            Activo
                            @else
                            Desactivado
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Categoría:</strong>
                            {{ $producto->categorium->nombre }}
                        </div>

                        <div class="form-group">
                            <strong>Insumos:</strong>
                            <ul>
                                @foreach($producto->insumos as $insumo)
                                <li>{{ $insumo->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- <div class="float-center">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Volver</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection