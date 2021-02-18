<!-- @extends('posts.app')
@section('content')
    <div class="container">
        @isset($articles)
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            @foreach($articles as $key=>$article)
                                <thead>
                                <tr>
                                    <th width="5">Название</th>
                                    <th>description</th>
                                    <th>aвтор</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td><a href="{{ URL('article/'.$article->id) }}">{{ $article->title }}</a></td>
                                    <td>{{ $article->name }}</td>
                                    <td>{{ $article->user->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
 -->