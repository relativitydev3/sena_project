@extends('layouts.app')

@section('title')
Detalle
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('categoria.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h3 class="page__heading ml-3 mb-0">Detalle de Categoria</h3>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <img src="{{ asset($categorium->imagen) }}" class="img-thumbnail" alt="Imagen del categoria" width="115px">
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $categorium->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $categorium->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            @if ($categorium['activo'] == 1)
                            Activo
                            @else
                            Desactivado
                            @endif
                        </div>
                        <!-- <div class="float-center">
                            <a class="btn btn-primary" href="{{ route('categoria.index') }}"> Volver</a>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection