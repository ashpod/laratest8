@extends('posts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th width="5">title</th>
                        <th>description</th>
                        <th>avtorname</th>
                        <th>created_at</th>
                        <th>Управление</th>
                        {{--@auth--}}
                        {{--<th><a href="{{ URL('post/create') }}" class="btn btn-success btn-xs">Добавить</a></th>--}}
                        {{--@endauth--}}
                    </tr>
                    </thead>
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at }}</td>
                        @auth
                            <td>
                                @can('delete', $post)
                                    <a href="{{ URL('post/'.$post->id.'/edit') }}"
                                       class="btn btn-xs btn-info">редактировать</a>
                                    <form action="{{ URL('post/'.$post->id) }}" method="post">
                                        {!! csrf_field() !!}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-xs btn-danger">Удалить</button>
                                    </form>
                                @endcan
                            </td>
                        @endauth
                    </tr>
                </table>
                <form action="" method="post">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    {!! csrf_field() !!}
                    {{ method_field('GET') }}

                    <button type="submit" class="btn btn-success btn-xs">Добавить Комментарий</button>
                </form>
            </div>
        </div>
    </div>
@endsection
