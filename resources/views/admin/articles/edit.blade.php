@extends('admin.template.main')
@section('title', 'Editar Artículo')
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')

    {!! Form::open([
        'route'=>['articles.update', $article->id],
        'method'=>'PUT',
        //'files'=>true,
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group">
        {!! Form::label('title', 'Título', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('title', $article->title, ['class' => 'form-control', 'placeholder'=>'Título', 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Categorías', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!!
                Form::select('category_id', $categories, $article->category_id, ['class' => 'form-control select-category', 'required'] );
            !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('content', 'Contenido', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::textArea('content', $article->content, ['class' => 'form-control text-content', 'placeholder'=>'Contenido']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('tags', 'Tags', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!!
                Form::select('tags[]', $tags, $tags_ids, ['class' => 'form-control select-tags', 'multiple', 'required'] );
            !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            {!! Form::submit('Enviar',['class' => 'btn btn-primary col-md-3']) !!}
            <a href="{{url()->previous()}}" class="btn btn-default col-sm-offset-1">Cancelar</a>
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@section('js')
    <script>

        $('.select-tags').chosen({
            placeholder_text_multiple:'Seleccionar tags',
            no_results_text: 'No se encontró el tag',

        });

        $('.select-category').chosen({
            placeholder_text_single:'Seleccionar categoría',
            no_results_text: 'No se encontró la categoría',

        });

        $('.text-content').trumbowyg();

    </script>
@endsection