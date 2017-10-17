@extends('admin.template.main')
@section('title', 'Galería de imágenes')

@section('content')
    <div class="row">
        @foreach($images as $image)
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="/images/articles/{{ $image->name }}" alt="..." class="img-responsive">
                <div class="caption">
                    <h4 class="text-center">{{ $image->article->title }}</h4>
                </div>
                <div class="text-center bg-primary">{{ $image->article->category->name }}</div>
                <div class="text-center bg-info">{{ $image->article->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center">
        {!! $images->render() !!}
    </div>

@endsection