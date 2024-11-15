@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Contribuyentes</h1>
@stop

@section('content')
    <div class="card p-4">
        <div class="card-header d-flex align-items-center">
            <h1 class="card-title">Listado de Contribuyentes</h1>
            @hasrole('Super Usuario')
            <a href="{{ route('contribuyentes.create') }}" class="btn btn-success ml-auto">Crear Contribuyente</a>
            @endhasrole
        </div>


        <div class="card-body">

            {{-- Formulario de Filtros --}}
            <form method="GET" action="{{ route('contribuyentes.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="tipo_documento" class="form-control" placeholder="Tipo Documento" value="{{ request('tipo_documento') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="documento" class="form-control" placeholder="Documento" value="{{ request('documento') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="nombres" class="form-control" placeholder="Nombres" value="{{ request('nombres') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="{{ request('apellidos') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ request('telefono') }}">
                    </div>

                    <div class="row col-md-2">
                        <button type="submit" class="btn btn-primary mr-2">Filtrar</button>
                        <a href="{{ route('contribuyentes.index') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </div>

            </form>

            {{-- Tabla de Contribuyentes --}}
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo Documento</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Teléfono</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contribuyentes as $contribuyente)
                    <tr>
                        <th scope="row">{{ $contribuyente->id }}</th>
                        <td>{{ $contribuyente->tipo_documento }}</td>
                        <td>{{ $contribuyente->documento }}</td>
                        <td>{{ $contribuyente->nombres }}</td>
                        <td>{{ $contribuyente->apellidos }}</td>
                        <td>{{ $contribuyente->telefono }}</td>
                        @hasrole('Super Usuario')
                        <td>
                            <a href="{{ route('contribuyentes.show', $contribuyente->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('contribuyentes.edit', $contribuyente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('contribuyentes.destroy', $contribuyente->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este contribuyente?')">Eliminar</button>
                            </form>
                        </td>
                        @endhasrole
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-transparent">
            <nav aria-label="Paginación de contribuyentes">
                <ul class="pagination justify-content-center">
                    {{-- Botón "Anterior" --}}
                    <li class="page-item {{ $contribuyentes->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $contribuyentes->previousPageUrl() }}" tabindex="-1">Anterior</a>
                    </li>

                    {{-- Enlaces de páginas --}}
                    @for ($i = 1; $i <= $contribuyentes->lastPage(); $i++)
                        <li class="page-item {{ $contribuyentes->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $contribuyentes->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Botón "Siguiente" --}}
                    <li class="page-item {{ $contribuyentes->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $contribuyentes->nextPageUrl() }}">Siguiente</a>
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
