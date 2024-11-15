@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Tablero</h1>
@stop

@section('content')
<div class="card p-4">
    <div class="card-header">
        <h1 class="card-title">Inicio</h1>
    </div>

    <div class="card-body">

    </div>

    <div class="card-footer bg-transparent">

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
