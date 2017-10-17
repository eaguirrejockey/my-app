@extends('admin.template.main')
@section('title', 'Crear Usuario')
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')

    {!! Form::open([
        'route'=>'users.store',
        'method'=>'POST',
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Nombre completo', 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Correo electronico', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::email('email', null, ['class' => 'form-control',  'placeholder'=>'ejemplo@dominio.com', 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Contraseña', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password', ['class' => 'form-control',  'placeholder'=>'*********', 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('type', 'Tipo', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], null, ['class' => 'form-control', 'placeholder'=>'Seleccione un nivel']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::submit('Enviar',['class' => 'btn btn-primary col-md-3']) !!}
            <a href="{{url()->previous()}}" class="btn btn-default col-sm-offset-1">Cancelar</a>
        </div>

    </div>

    {!! Form::close() !!}
@endsection