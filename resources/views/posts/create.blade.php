@extends('posts.app')
@section('content')
    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="{{ URL('/post') }}{{ isset($post) ? '/'.$post->id:'' }}" method="post">
                <div class="form-group">
                    {!! csrf_field() !!}
                    @if (isset($post))
                        {{ method_field('PUT') }}
                    @endif
                    <input type="text" class="form-control" name="title"
                           value="{{ isset($post) ? $post->title : '' }}">
                    <input type="text" class="form-control" name="name"
                           value="{{ isset($post) ? $post->name : '' }}">
                    <button type="submit" class="btn btn-sm btn-success">Добавить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
