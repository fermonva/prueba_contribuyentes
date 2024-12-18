@extends('adminlte::page')

@section('title', 'Crear Contribuyente')

@section('content_header')
    <h1>Crear Contribuyente</h1>
@stop

@section('content')
    <div class="card p-4">
        <div class="card-header d-flex align-items-center">
            <h1 class="card-title">Nuevo Contribuyente</h1>
            <a href="{{ route('contribuyentes.index') }}" class="btn btn-secondary ml-auto">Atrás</a>
        </div>

        <div class="card-body">
            {{-- Formulario para crear contribuyente --}}
            <form action="{{ route('contribuyentes.store') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- Tipo de Documento --}}
                    <div class="col-md-6 mb-3">
                        <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                        <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                            <option value="NIT" {{ old('tipo_documento') == 'NIT' ? 'selected' : '' }}>NIT</option>
                        </select>
                        @error('tipo_documento')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Documento --}}
                    <div class="col-md-6 mb-3">
                        <label for="documento" class="form-label">Documento</label>
                        <input type="text" name="documento" class="form-control" id="documento" value="{{ old('documento') }}" required>
                        @error('documento')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nombres --}}
                    <div class="col-md-6 mb-3" id="nombres_div">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" class="form-control" id="nombres" value="{{ old('nombres') }}">
                        @error('nombres')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Apellidos --}}
                    <div class="col-md-6 mb-3" id="apellidos_div">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" id="apellidos" value="{{ old('apellidos') }}">
                        @error('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Razón Social --}}
                    <div class="col-md-6 mb-3" id="razon_social_div" style="display: none;">
                        <label for="razon_social" class="form-label">Razón Social</label>
                        <input type="text" name="razon_social" class="form-control" id="razon_social" value="{{ old('razon_social') }}">
                        @error('razon_social')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Dirección --}}
                    <div class="col-md-6 mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion') }}">
                        @error('direccion')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono') }}">
                        @error('telefono')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Celular --}}
                    <div class="col-md-6 mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" name="celular" class="form-control" id="celular" value="{{ old('celular') }}">
                        @error('celular')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Usuario --}}
                    <div class="col-md-6 mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" name="usuario" class="form-control" id="usuario" value="{{ old('usuario') }}" required>
                        @error('usuario')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Botón de Guardar --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Contribuyente</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipoDocumento = document.getElementById('tipo_documento');
            const nombresDiv = document.getElementById('nombres_div');
            const apellidosDiv = document.getElementById('apellidos_div');
            const razonSocialDiv = document.getElementById('razon_social_div');

            // Función para manejar el cambio de tipo de documento
            tipoDocumento.addEventListener('change', function () {
                if (tipoDocumento.value === 'NIT') {
                    nombresDiv.style.display = 'none';  // Ocultar los campos de nombres
                    apellidosDiv.style.display = 'none';  // Ocultar los campos de apellidos
                    razonSocialDiv.style.display = 'block';  // Mostrar el campo de razón social
                } else {
                    nombresDiv.style.display = 'block';  // Mostrar los campos de nombres
                    apellidosDiv.style.display = 'block';  // Mostrar los campos de apellidos
                    razonSocialDiv.style.display = 'none';  // Ocultar el campo de razón social
                }
            });

            // Inicializar la vista dependiendo del valor seleccionado
            tipoDocumento.dispatchEvent(new Event('change'));
        });
    </script>
@stop
