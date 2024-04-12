@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('A_clientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">Editar Cliente</h3>
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



                            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['A_clientes.update', $user->id]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('documento') ? 'is-invalid' : '' }}">
                                        <label for="documento">Documento</label>
                                        {!! Form::text('documento', null, ['class' => 'form-control ' . ($errors->has('documento') ? 'is-invalid' : '')]) !!}
                                        @if ($errors->has('documento'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('documento') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                        <label for="name">Nombre</label>
                                        {!! Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '')]) !!}
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('apellidos') ? 'is-invalid' : '' }}">
                                        <label for="apellidos">Apellidos</label>
                                        {!! Form::text('apellidos', null, ['class' => 'form-control ' . ($errors->has('apellidos') ? 'is-invalid' : '')]) !!}
                                        @if ($errors->has('apellidos'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('apellidos') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <select class="form-control" id="estado" name="estado">
                                            <option value="1"
                                                {{ isset($user) && $user->estado == 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0"
                                                {{ isset($user) && $user->estado == 0 ? 'selected' : '' }}>Inactivo
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('telefono') ? 'is-invalid' : '' }}">
                                        <label for="telefono">Teléfono</label>
                                        {!! Form::text('telefono', null, ['class' => 'form-control ' . ($errors->has('telefono') ? 'is-invalid' : '')]) !!}
                                        @if ($errors->has('telefono'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('telefono') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('direccion') ? 'is-invalid' : '' }}">
                                        <label for="direccion">Dirección</label>
                                        {!! Form::text('direccion', null, ['class' => 'form-control ' . ($errors->has('direccion') ? 'is-invalid' : '')]) !!}
                                        @if ($errors->has('direccion'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('direccion') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                        <label for="email">E-mail</label>
                                        {!! Form::text('email', null, ['class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : '')]) !!}
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                        <label for="password">Contraseña</label>
                                        <div class="input-group">
                                            {!! Form::password('password', [
                                                'class' => 'form-control ' . ($errors->has('password') ? 'is-invalid' : ''),
                                                'id' => 'password',
                                            ]) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="cursor: pointer;"
                                                    onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
                                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('confirm-password') ? 'is-invalid' : '' }}">
                                        <label for="confirm-password">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            {!! Form::password('confirm-password', [
                                                'class' => 'form-control ' . ($errors->has('confirm-password') ? 'is-invalid' : ''),
                                                'id' => 'confirm-password',
                                            ]) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="cursor: pointer;"
                                                    onclick="togglePasswordVisibility('confirm-password', 'toggleConfirmPasswordIcon')">
                                                    <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('confirm-password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('confirm-password') }}
                                            </div>
                                        @endif
                                        </div>
                                        
                                    </div>
                                </div>

                                <script>
                                    function togglePasswordVisibility(inputId, iconId) {
                                        var passwordInput = document.getElementById(inputId);
                                        var passwordIcon = document.getElementById(iconId);
                                
                                        if (passwordInput.type === 'password') {
                                            passwordInput.type = 'text';
                                            passwordIcon.classList.remove('fa-eye');
                                            passwordIcon.classList.add('fa-eye-slash');
                                        } else {
                                            passwordInput.type = 'password';
                                            passwordIcon.classList.remove('fa-eye-slash');
                                            passwordIcon.classList.add('fa-eye');
                                        }
                                    }
                                </script>

                                <div class="col-xs-12 col-sm-6 col-md-6" style="display: none;">
                                    <div class="form-group">
                                        <label for="">Roles</label>
                                        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control']) !!}
                                    </div>
                                </div>


                            </div>

                            <div class="col-xs-12 col-sm-12 col-md 12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Guardar</button>

                                </div>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
