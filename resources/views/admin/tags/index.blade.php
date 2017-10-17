@extends('admin.template.main')
@section('title', 'Lista de tags')

@section('content')
    <a class="btn btn-info" href="{{  route('tags.create') }}">Crear Tag</a>
    <hr>
    {{-- BUCADOR --}}
        {!! Form::open([
            'route'=>'tags.index',
            'method'=>'GET',
            'class'=>'navbar-form pull-right'
        ]) !!}

                <div class="input-group">

                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Buscar tag']) !!}
                    <span class="input-group-btn">
                        {!! Form::button('<span class="glyphicon glyphicon-search"></span>', array('class'=>'btn btn-default', 'type'=>'submit')) !!}
                    </span>

                </div>


        {!! Form::close() !!}

    {{-- FIN BUCADOR --}}

    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-sm-1">#</th>
            <th class="col-md-9">Nombre</th>
            <th class="col-md-2">Acción</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td scope="row" class="col-sm-1">{{ $tag->id }}</td>
                    <td class="col-md-9">{{ $tag->name }}</td>
                    <td class="col-md-2">
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary glyphicon glyphicon-wrench"></a>
                        <a href="{{ route('tags.destroy', $tag->id) }}" onclick="confirm('Desea borrarla?');" class="btn btn-danger glyphicon glyphicon-trash"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $tags->render() !!}
    </div>

@endsection