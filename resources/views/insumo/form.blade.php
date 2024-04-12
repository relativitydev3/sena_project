<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            <label for="imagen">Imagen</label>
            @if ($insumo->imagen)
                <div>
                    <img src="{{ asset($insumo->imagen) }}" alt="Imagen actual" width="200">
                </div>
            @endif
            <input type="file" name="imagen" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}"
                placeholder="Imagen">
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="{{ $insumo->nombre }}"
                        class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder=""
                        onkeyup="validateNombre(this)" onchange="removeSpaces(this)">
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-md-4">
                    <label for="cantidad_disponible">Cantidad de bolsas disponibles</label>
                    <input type="text" name="cantidad_disponible" value="{{ round($insumo->cantidad_disponible/3) }}"
                        class="form-control{{ $errors->has('cantidad_disponible') ? ' is-invalid' : '' }}"
                        placeholder="" onkeyup="validatePrecio(this)" onchange="removeSpaces(this)">
                    {!! $errors->first('cantidad_disponible', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-md-4">
                    <label for="precio_unitario">Precio Unitario</label>
                    <input type="text" name="precio_unitario" value="{{ $insumo->precio_unitario }}"
                        class="form-control{{ $errors->has('precio_unitario') ? ' is-invalid' : '' }}"
                        placeholder="" onkeyup="validatePrecio(this)" onchange="removeSpaces(this)">
                    {!! $errors->first('precio_unitario', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
      {{-- <div class="form-group">
            <div class="row"> 
                <div class="col-md-6">
                    <label for="unidad_medida">Unidad de Medida</label>
                    <select name="unidad_medida"
                        class="form-control{{ $errors->has('unidad_medida') ? ' is-invalid' : '' }}">
                        <option value="Bolsas" {{ $insumo->unidad_medida == 'Bolsas' ? 'selected' : '' }}>Bolsas
                        </option>
                        <option value="Kilogramos" {{ $insumo->unidad_medida == 'Kilogramos' ? 'selected' : '' }}>
                            Kilogramos</option>
                        <option value="Libras" {{ $insumo->unidad_medida == 'Libras' ? 'selected' : '' }}>Libras
                        </option>
                    </select>
                    {!! $errors->first('unidad_medida', '<div class="invalid-feedback">:message</div>') !!}
                </div> 

            </div>
        </div>  --}}

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
    // Funcion para evitar el escribir cualquier otro dato que no sea numerico
    function validatePrecio(input) {
        const inputValue = input.value.trim(); // Eliminar espacios al inicio y al final
        // Validar longitud total del valor ingresado (incluyendo dígitos y puntos)
        if (inputValue.length > 5) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El precio no puede tener más de 5 caracteres',
            });
            input.value = inputValue.substring(0, 5); // Truncar el valor a 8 caracteres
            return;
        }
        // Validar si el valor ingresado contiene caracteres diferentes a números y el punto
        for (let i = 0; i < inputValue.length; i++) {
            const charCode = inputValue.charCodeAt(i);

            // Aceptar solo números (48-57) y el punto (46)
            if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El precio debe ser un número válido',
                });
                input.value = ''; // Limpia el valor del campo si no es válido
                return;
            }
        }
    }
</script>
