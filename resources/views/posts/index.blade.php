@extends('posts.app')
@section('content')
    <div class="container">
        @isset($posts)
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            @foreach($posts as $key=>$post)
                                <thead>
                                <tr>
                                    <th width="5">Название</th>
                                    <th>description</th>
                                    <th>aвтор</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td><a href="{{ URL('post/'.$post->id) }}">{{ $post->title }}</a></td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $posts->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
