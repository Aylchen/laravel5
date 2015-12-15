@extends('main')

@section('content')

    <h1 class="text-left">我的评论</h1>
    @include('error')

    <div class="am-list-news-bd">
        <ul class="am-list">
            @forelse($comments as $comment)
                <li class="am-g am-list-item-dated">
                    <a href="{{ url('articles', $comment->article_id) }}" class="am-list-item-hd ">文章链接：{{ $comment->article->title }} </a>
                    <span class="am-list-date" style="font-size:1rem"> {{ $comment->updated_at }}</span>
                    <div class="am-list-item-text"><strong>我的评论：</strong>{{ $comment->content }}</div>
                    <div class="pull-right absolute-btn">
                        <a type="button" class="am-btn am-btn-danger am-btn-xs am-radius" href="{{ url('user', ['comments', 'delete',$comment->id]) }}" style="padding-right:1rem;">删除</a>
                        <a type="button" class="am-btn am-btn-primary am-btn-xs am-radius" href="{{ url('user', ['comments', $comment->id]) }}" style="padding-right:1rem;">编辑</a>
                    </div>
                </li>
            @empty
                <li class="am-g am-list-item-desced">暂无评论</li>
            @endforelse
        </ul>
        {!! $comments->render() !!}
    </div>
@endsection


