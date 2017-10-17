@extends('admin.template.main')
@section('title', 'Lista de usuarios')

@section('content')
    <a class="btn btn-info" href="{{  route('users.create') }}">Crear Usuario</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->type=='admin')
                            <span class="label label-danger">{{ $user->type }}</span>
                        @else
                            <span class="label label-primary">{{ $user->type }}</span>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary glyphicon glyphicon-wrench"></a>
                        <a href="{{ route('users.destroy', $user->id) }}" onclick="confirm('Desea borrarlo?');" class="btn btn-danger glyphicon glyphicon-trash"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $users->render() !!}
    </div>
@endsection