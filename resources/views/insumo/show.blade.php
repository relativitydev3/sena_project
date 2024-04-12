@extends('layouts.app')

@section('title')
Detalle
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('insumo.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h3 class="page__heading ml-3 mb-0">Detalle de insumo</h3>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <img src="{{ asset($insumo['imagen']) }}" class="img-thumbnail" alt="Imagen del insumo" width="115px">
                        </div>
                        <br>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $insumo['nombre'] }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            @if ($insumo['activo'] == 1)
                            Activo
                            @else
                            Desactivado
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Cantidad Disponible:</strong>
                            {{ $insumo['cantidad_disponible'] }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad Medida:</strong>
                            {{ $insumo['unidad_medida'] }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Unitario:</strong>
                            {{ $insumo['precio_unitario'] }}
                        </div>
                        <!-- <div class="float-center">
                            <a class="btn btn-primary" href="{{ route('insumo.index') }}"> Volver</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection