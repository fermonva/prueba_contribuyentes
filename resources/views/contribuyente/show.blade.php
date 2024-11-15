@extends('adminlte::page')

@section('title', 'Ver Contribuyente')

@section('content_header')
    <h1>Ver Contribuyente</h1>
@stop

@section('content')
    <div class="card p-4">
        <div class="card-header d-flex align-items-center">
            <h1 class="card-title">Detalles del Contribuyente</h1>
            <a href="{{ route('contribuyentes.index') }}" class="btn btn-secondary ml-auto">Atrás</a>
        </div>

        <div class="card-body">
            {{-- Detalles del contribuyente --}}
            <div class="row">
                {{-- Tipo de Documento --}}
                <div class="col-md-6 mb-3">
                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                    <p>{{ $contribuyente->tipo_documento }}</p>
                </div>

                {{-- Documento --}}
                <div class="col-md-6 mb-3">
                    <label for="documento" class="form-label">Documento</label>
                    <p>{{ $contribuyente->documento }}</p>
                </div>

                {{-- Nombres --}}
                <div class="col-md-6 mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <p>{{ $contribuyente->nombres }}</p>
                </div>

                {{-- Apellidos --}}
                <div class="col-md-6 mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <p>{{ $contribuyente->apellidos }}</p>
                </div>

                {{-- Dirección --}}
                <div class="col-md-6 mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <p>{{ $contribuyente->direccion }}</p>
                </div>

                {{-- Teléfono --}}
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <p>{{ $contribuyente->telefono }}</p>
                </div>

                {{-- Celular --}}
                <div class="col-md-6 mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <p>{{ $contribuyente->celular }}</p>
                </div>

                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <p>{{ $contribuyente->email }}</p>
                </div>

                {{-- Usuario --}}
                <div class="col-md-6 mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <p>{{ $contribuyente->usuario }}</p>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script>
        console.log("Vista de contribuyente cargada");
    </script>
@stop
