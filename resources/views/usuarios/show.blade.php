@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">Informacion del cliente</h3>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h5>Documento: {{ $user->documento }}</h5>
                    <h5>Nombre: {{ $user->name }}</h5>
                    <h5>Apellidos: {{ $user->apellidos }}</h5>
                    <h5><strong>Estado:</strong> <span class="{{ $user->estado ? 'badge badge-success' : 'badge badge-danger' }}">{{ $user->estado ? 'Activo' : 'Inactivo' }}</span></h5>
                    <h5>Email: {{ $user->email }}</h5>
                    <h5>Dirección: {{ $user->direccion }}</h5>
                    <h5>Teléfono: {{ $user->telefono }}</h5>
                    <h5>Rol: 
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $rolNombre)
                                <span class="badge badge-dark">{{ $rolNombre }}</span>
                            @endforeach
                        @else
                            <span>No asignado</span>
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    </section>
@endsection

