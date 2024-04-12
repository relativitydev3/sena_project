@extends('layouts.app')

@section('title')
Crear Categoría
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('categoria.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h3 class="page__heading ml-3 mb-0">Crear Categoría </h3>
    </div>
    <div class="section-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>¡Revise los campos!</strong>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">

                <div class="card">

                    @includeif('partials.errors')

                    <div class="card-body">
                        <form method="POST" action="{{ route('categoria.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('categorium.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection