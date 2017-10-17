@extends('admin.template.main')
@section('title', 'Lista de categorías')

@section('content')
    <a class="btn btn-info" href="{{  route('categories.create') }}">Crear Categoría</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-sm-1">#</th>
            <th class="col-md-9">Nombre</th>
            <th class="col-md-2">Acción</th>
        </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td scope="row" class="col-sm-1">{{ $category->id }}</td>
                    <td class="col-md-9">{{ $category->name }}</td>
                    <td class="col-md-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary glyphicon glyphicon-wrench"></a>
                        <a href="{{ route('categories.destroy', $category->id) }}" onclick="confirm('Desea borrarlo?');" class="btn btn-danger glyphicon glyphicon-trash"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $categories->render() !!}
    </div>

@endsection