<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), '' => 'Imagen']) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('nombre') }}
                    {{ Form::text('nombre', $categorium->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), '' => 'Nombre', 'onkeyup' => 'validateNombre(this)', 'onblur' => 'removeSpaces(this)']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="col-md-6">
                    {{ Form::label('descripción') }}
                    {{ Form::text('descripcion', $categorium->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), '' => 'Descripción', 'onkeyup' => 'validateDescripcion(this)']) }}
                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
<script>
    // Función para eliminar espacios en blanco de izquierda y derecha
    function removeSpaces(input) {
        input.value = input.value.trim();
    }
    // Función para validar el campo de nombre
    function validateNombre(input) {
        for (let i = 0; i < input.value.length; i++) {
            const charCode = input.value.charCodeAt(i);

            // Aceptar letras mayúsculas (65-90), letras minúsculas (97-122) y espacio (32)
            if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode !== 32) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre solo puede contener letras y espacios',
                });
                input.value = ''; // Limpia el valor del campo si no es válido
                return;
            }
        }
    }
    // Función para validar el campo de descripción
    function validateDescripcion(input) {
        for (let i = 0; i < input.value.length; i++) {
            const charCode = input.value.charCodeAt(i);

            // Aceptar letras mayúsculas (65-90), letras minúsculas (97-122), espacios (32), comas (44), puntos (46), signo de exclamación (33) y signo de exclamación abierto (161)
            if (
                (charCode < 65 || charCode > 90) &&
                (charCode < 97 || charCode > 122) &&
                charCode !== 32 &&
                charCode !== 44 &&
                charCode !== 46 &&
                charCode !== 33 &&
                charCode !== 161
            ) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La descripción solo puede contener letras, espacios, comas, puntos y signos de exclamación',
                });
                input.value = ''; // Limpia el valor del campo si no es válido
                return;
            }
        }
    }
</script>