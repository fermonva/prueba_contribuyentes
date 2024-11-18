@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Gestión de Roles</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Roles</h3>
            @can('crear roles')
            <a href="{{ route('roles.create') }}" class="btn btn-primary float-right">Crear Rol</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Permisos</th>

                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            {{ implode(', ', $role->permissions->pluck('name')->toArray()) }}
                        </td>
                        <td>
                            @can('editar roles')
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            @endcan
                                @can('eliminar roles')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este rol?')">Eliminar</button>
                            </form>
                                @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
