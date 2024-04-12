@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">informacion de Rol</h3>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4>Nombre del Rol: <span class="text-primary">{{ $role->name }}</span></h4>

                            <h4>Permisos para este Rol:</h4>
                            @if ($role->name === 'administrador')
                            <li class="list-group-item">Dashboard</li>
                            <li class="list-group-item">Roles</li>
                            <li class="list-group-item">Usuarios</li>
                            <li class="list-group-item">Clientes</li>
                            <li class="list-group-item">Categoria de productos</li>
                            <li class="list-group-item">Productos</li>
                            <li class="list-group-item">Insumos</li>
                            <li class="list-group-item">Pedidos</li>
                            <li class="list-group-item">Ventas</li>
                            <li class="list-group-item">Pedidos Cliente</li>
                            
                            @elseif ($role->name === 'cliente')
                            <li class="list-group-item">Pedidos Cliente</li>
                            @else
                                <ul class="list-group">
                                    @foreach($permissions as $permission)
                                        @if(in_array($permission->id, $rolePermissions))
                                            <li class="list-group-item">{{ $permission->name }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
