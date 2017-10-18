@extends('admin.template.main')
@section('title', 'Lista de artículos')

@section('content')
    <a class="btn btn-info" href="{{ route('articles.create') }}">Crear Artículo</a>
    <hr>
    {{-- BUCADOR --}}
    {!! Form::open([
        'route'=>'articles.index',
        'method'=>'GET',
        'class'=>'navbar-form pull-right'
    ]) !!}

        <div class="input-group">

            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Buscar artículo']) !!}
            <span class="input-group-btn">
                {!! Form::button('<span class="glyphicon glyphicon-search"></span>', array('class'=>'btn btn-default', 'type'=>'submit')) !!}
            </span>

        </div>

    {!! Form::close() !!}

    {{-- FIN BUCADOR --}}

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Categoría</th>
            <th>Tags</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td><a href="{{ route('articles.category', $article->category->name) }}" class="text-center">{{ $article->category->name}}</a></td>
                    <td>
                        @foreach($article->tags as $tag)
                            <a href="{{ route('articles.tag', $tag->id) }}" style="text-decoration: none;">
                                <span class="label label-default">{{ $tag->name }}</span>
                            </a>
                        @endforeach
                    </td>
                    <td>
                        @can('update-article', $article)
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary glyphicon glyphicon-wrench"></a>
                        <a href="{{ route('articles.destroy', $article->id) }}" onclick="confirm('Desea borrarlo?');" class="btn btn-danger glyphicon glyphicon-trash"></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $articles->render() !!}
    </div>
@endsection