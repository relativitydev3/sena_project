@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">Editar Rol</h3>
                </div>
            </div>
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
                        <div class="card-body">
                            
                        

                        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Rol:</label>
                                    {!! Form::text('name', null, array('class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : ''))) !!}
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Permisos para este Rol:</label>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                        {{ $value->name }}</label>
                                    <br/>
                                    @endforeach
                                    <div class="">
                                        @foreach ($errors->get('permission') as $error)
                                            <div style="color: red;">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                                            
                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            
                        </div>
                    {!! Form::close() !!}
                    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection