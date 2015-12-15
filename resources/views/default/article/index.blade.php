@extends('main')

@section('content')
<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
    <!--列表标题-->
    <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <h1 class="text-left">
            {{ $title }}&nbsp;&nbsp;
            <a href="{{ url('articles', 'create') }}" class="btn btn-info pull-right">新增文章</a>
        </h1>
        @include('search', true)
    </div>

    <div class="am-list-news-bd">
        <ul class="am-list">
            @forelse($articles as $article)
            <li class="am-g am-list-item-dated">
                <a href="{{ url('articles', $article->id) }}" class="am-list-item-hd ">
                    {!! str_replace($key, '<span style="color:red">'.$key."</span>", $article->title) !!}
                </a>
                <span class="am-list-date">{{ $article->created_at }}</span>
                <div class="am-list-item-text">{{ str_limit($article->content, 300) }}</div>
            </li>
            @empty
                <li class="am-g am-list-item-desced">暂无文章</li>
            @endforelse
        </ul>
        {!! $articles->render() !!}
    </div>

</div>
@endsection