@extends('admin.template.main')
@section('title', 'Editar Categoría'.$category->name)
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')

    {!! Form::open([
        'route'=>['categories.update', $category->id],
        'method'=>'PUT',
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Categoría', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder'=>'Categoría', 'required']) !!}
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