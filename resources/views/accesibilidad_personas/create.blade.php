@extends('adminlte::page')

@section('title', 'Crear Persona')

@section('content_header')
<h1>Crear Contribuyente</h1>
@stop

@section('content')
<div class="card p-4">
    <div class="card-header d-flex align-items-center">
        <h1 class="card-title">Nuevo Persona</h1>
        <a href="{{ route('accesibilidad_personas.index') }}" class="btn btn-secondary ml-auto">Atrás</a>
    </div>


    <div class="card-body">
        {{-- Formulario para crear persona --}}
        <form action="{{ route('accesibilidad_personas.store') }}" method="POST">
            @csrf
            <div class="row">

                {{-- Departamentos --}}
                <div class="col-md-6 mb-3">
                    <label for="dipo_dep_id" class="form-label">Departamento</label>
                    <select name="dipo_dep_id" id="dipo_dep_id" class="form-control" required>
                        <option value="">Seleccione un departamento</option>
                        @foreach ($departamentos as $dipo_dep_id => $dipo_departamento)
                        <option value="{{ $dipo_dep_id }}" {{ old('dipo_dep_id') == $dipo_dep_id ? 'selected' : '' }}>
                            {{ $dipo_departamento }}
                        </option>
                        @endforeach
                    </select>
                    @error('dipo_dep_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Municipios --}}
                <div class="col-md-6 mb-3">
                    <label for="dipo_id" class="form-label">Municipio</label>
                    <select name="dipo_id" id="dipo_id" class="form-control" required>
                        <option value="">Seleccione un municipio</option>
                    </select>
                    @error('dipo_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


            </div>

            {{-- Botón de Guardar --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Guardar Persona</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Detectar cambio en el select de departamento
        $('#dipo_dep_id').on('change', function() {
            var dipo_dep_id = $(this).val();
            if (dipo_dep_id) {
                // Hacer la solicitud AJAX para obtener los municipios
                $.ajax({
                    url: '/accesibilidad_personas/municipios/' + dipo_dep_id, // Ruta a la que haremos la petición
                    method: 'GET',
                    success: function(data) {
                        var municipios = data.municipios;
                        var municipioSelect = $('#dipo_id');
                        municipioSelect.empty(); // Limpiar las opciones anteriores
                        municipioSelect.append('<option value="">Seleccione un municipio</option>'); // Opción por defecto

                        // Agregar los municipios a la lista
                        $.each(municipios, function(dipo_id, dipo_ciudad) {
                            municipioSelect.append('<option value="' + dipo_id + '">' + dipo_ciudad + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@stop