@extends('main')

@section('content')
    <Article>
        <div class="pull-left">
            <a href="javascript:history.back();"> <<&nbsp;返回 </a>
        </div>
       {{-- @if( ! empty(Auth::user()) && ( $article->user_id == Auth::user()->id ) )--}}
        <div class="pull-right">
            <a href="{{ url('articles', [$article->id, 'edit']) }} " class="btn btn-primary">Edit</a>
            <a href="{{ url('articles', [$article->id, 'delete']) }}" class="btn btn-danger">Delete</a>
        </div>
      {{--  @endif--}}
        <div class="page-header">
            <h3>{{ $article->title }}</h3>
            <div class="text-right">
                {{ $article->user->username }}
                <small>{{ $article->created_at }}</small>
            </div>
        </div>
        <pre>{{ $article->content }}</pre>

    </Article>
    <hr/>
    <div class="link-div">
        @if(! empty($prev_id))
            <a href="{{ url('articles', $prev_id) }}" class="text-left"><<上一篇</a>
        @endif
        @if(! empty($next_id))
            <a href="{{ url('articles', $next_id) }}" class="pull-right">下一篇>></a>
        @endif
    </div>
    {{-- commit a comment by the current user --}}
    <comment>
        @include('error')
        {!! Form::open(['url'=>url('comments', $article->id)]) !!}
        <div class="form-group">
            {!! Form::label('content','发表评论') !!}
            {!! Form::textarea('content', null, ['rows' => 3, 'class' => 'form-control', 'placeholder' => 'Say Something...']) !!}
        </div>
        {!! Form::hidden('article_id', $article->id) !!}
        {!! Form::submit('提交评论', ['class'=>'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
    </comment>
    {{-- comment list --}}
    <comments>

        <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
            <div class="am-list-news-hd am-cf">
                <h2>评论列表({{ $comments->count() }})：</h2>
            </div>

            <div class="am-list-news-bd">
                <ul class="am-list comment-list">
                    @forelse($comments as $comment)
                    <li class="am-g am-list-item-dated">
                        <a href="javascript:" class="am-list-item-hd " style="white-space: normal; padding-right:140px;"><strong>{{ $comment->user->username }}：</strong>{{ $comment->content }}</a>
                        <span class="am-list-date">{{ $comment->created_at }}</span>
                    </li>
                    @empty
                        <li class="am-g am-list-item-desced">暂无评论</li>
                    @endforelse

                </ul>
            </div>
        </div>
    </comments>
@endsection
