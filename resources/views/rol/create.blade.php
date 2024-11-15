@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')
    <div class="card p-4">
        <div class="card-header d-flex align-items-center">
            <h1 class="card-title">Crear Rol</h1>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary ml-auto">Atrás</a>
        </div>

        <div class="card-body">
            {{-- Formulario para crear el rol --}}
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                {{-- Nombre del Rol --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Permisos --}}
                <div class="mb-3">
                    <label class="form-label">Permisos</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->id }}"
                                        class="form-check-input"
                                        id="permission-{{ $permission->id }}"
                                        {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                    >
                                    <label for="permission-{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Botón de Guardar --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Crear Rol</button>
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
        console.log("Formulario de creación de rol cargado");
    </script>
@stop
