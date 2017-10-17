@extends('admin.template.main')
@section('title', 'Ud. no tiene acceso a esta zona.')
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '6')
@section('offset', '3')

@section('content')
    <a href="{{ url('/') }}">Volver al inicio</a>
@endsection