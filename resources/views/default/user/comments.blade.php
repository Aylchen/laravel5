@extends('main')

@section('content')

    <h1 class="text-left">我的评论</h1>
    <hr/>
    <ul class="list-group">
        @if( $comments->count() == 0 )
            <li class="list-group-item">暂无评论</li>
        @else
            @foreach($comments as $comment)
                <li class="list-group-item" style="position:relative;">
                    <div class="comment-user">
                        <h5 class="text-left">
                            <a href="{{ url('articles', $comment->article_id) }}">
                                {{ $comment->article->title }}
                            </a>
                        </h5>
                        <small class="text-warning">{{ $comment->updated_at }}</small>
                    </div>
                    <div class="comment-content">
                        {{ $comment->content }}
                    </div>
                    <div class="pull-right absolute-btn">
                        <a type="button" class="btn btn-info" href="{{ url('user', ['comments', $comment->id]) }}">编辑</a>
                        <a type="button" class="btn btn-danger" href="{{ url('user', ['comments', 'delete',$comment->id]) }}">删除</a>
                    </div>
                </li>
            @endforeach
            {!! $comments->render()  !!}
        @endif
    </ul>

@endsection