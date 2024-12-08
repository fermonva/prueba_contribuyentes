@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Personas</h1>
@stop

@section('content')
<div class="card p-4">
    <div class="card-header d-flex align-items-center">
        <h1 class="card-title">Listado de Personas</h1>
        @can('crear contribuyentes')
        <a href="{{ route('accesibilidad_personas.create') }}" class="btn btn-success ml-auto">Crear Persona</a>
        @endcan
    </div>


    <div class="card-body">

        {{-- Formulario de Filtros --}}
        <form method="GET" action="{{ route('accesibilidad_personas.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="tiid_id" class="form-control" placeholder="Tipo Documento" value="{{ request('tiid_id') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="prin_cedula" class="form-control" placeholder="Documento" value="{{ request('prin_cedula') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="prin_nombre_cp" class="form-control" placeholder="Nombres" value="{{ request('prin_nombre_cp') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="acpe_direccion" class="form-control" placeholder="Direccion" value="{{ request('acpe_direccion') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="prin_email" class="form-control" placeholder="Email" value="{{ request('prin_email') }}">
                </div>

                <div class="row col-md-2">
                    <button type="submit" class="btn btn-primary mr-2">Filtrar</button>
                    <a href="{{ route('accesibilidad_personas.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>

        </form>

        {{-- Tabla de Personas --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo Documento</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombres y Apellidos</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    <th scope="row">{{ $persona->acpe_id }}</th>
                    <th scope="row">{{ $persona->tiid_id }}</th>
                    <td>{{ $persona->prin_cedula }}</td>
                    <td>{{ $persona->prin_nombre_cp }}</td>
                    <td>{{ $persona->acpe_direccion }}</td>
                    <td>{{ $persona->prin_email }}</td>
                    <td>{{ $persona->prin_celular }}</td>
                    <td>{{ $persona->acpe_estado }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-transparent">
        <nav aria-label="Paginación de personas">
            <ul class="pagination justify-content-center">
                {{-- Botón "Anterior" --}}
                <li class="page-item {{ $personas->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $personas->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}" tabindex="-1">Anterior</a>
                </li>

                {{-- Enlaces de páginas --}}
                @for ($i = 1; $i <= $personas->lastPage(); $i++)
                    <li class="page-item {{ $personas->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $personas->url($i) . '&' . http_build_query(request()->except('page')) }}">{{ $i }}</a>
                    </li>
                    @endfor

                    {{-- Botón "Siguiente" --}}
                    <li class="page-item {{ $personas->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $personas->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}">Siguiente</a>
                    </li>
            </ul>
        </nav>
    </div>


</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
    <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop