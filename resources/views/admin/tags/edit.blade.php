@extends('admin.template.main')
@section('title', 'Editar Tag'.$tag->name)
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')

    {!! Form::open([
        'route'=>['tags.update', $tag->id],
        'method'=>'PUT',
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Tag', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder'=>'Tag', 'required']) !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::submit('Enviar',['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection