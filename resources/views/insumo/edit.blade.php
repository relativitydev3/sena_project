@extends('layouts.app')

@section('title')
Actualizar Insumo

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('insumo.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h3 class="page__heading ml-3 mb-0">Editar Insumo</h3>
    </div>

    <div class="section-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>¡Revise los campos!</strong>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                @includeif('partials.errors')

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('insumo.update', $insumo->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('insumo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection