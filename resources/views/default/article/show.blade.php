@extends('main')

@section('content')
    <Article>
        <div class="pull-left">
            <a href="javascript:history.back();"> <<&nbsp;返回 </a>
        </div>
        @if( $article->user_id == Auth::user()->id)
        <div class="pull-right">
            <a href="{{ url('articles', [$article->id, 'edit']) }} " class="btn btn-primary">Edit</a>
            <a href="{{ url('articles', [$article->id, 'delete']) }}" class="btn btn-danger">Delete</a>
        </div>
        @endif
        <div class="page-header">
            <h3>{{ $article->title }}</h3>
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
        {!! Form::open(['url'=>url('comments', $article->id)]) !!}
        <div class="form-group">
            {!! Form::label('content','发表评论') !!}
            {!! Form::textarea('content', null, ['rows' => 3, 'class' => 'form-control', 'placeholder' => 'Say Something...']) !!}
        </div>
        {!! Form::hidden('article_id', $article->id) !!}
        {!! Form::submit('提交评论', ['class'=>'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
        @include('error')
    </comment>
    {{-- comment list --}}
    <comments>
        <h3 class="text-left comment">评论列表({{ $comments->count() }})：</h3>
        <ul class="list-group comment-list">
        @if( $comments->count() == 0 )
            <li class="list-group-item">暂无评论</li>
        @else
            @foreach($comments as $comment)
                <li class="list-group-item">
                    <div class="comment-user">
                        <small class="text-primary">{{ $comment->created_at }}</small>
                        &nbsp;&nbsp;<strong>{{ $comment->user->username }}</strong>
                    </div>
                    <div class="comment-content">
                        {{ $comment->content }}
                    </div>
                </li>
            @endforeach
        @endif
        </ul>
    </comments>
@endsection

<script>
/*    $(function() {
        $('.comment-list').on('click', '.pagination a', function (e) {
            var url = $(this).attr('href');
            $(".comment-list").load(url+" .comment-list");
            return false;
        });
    });*/

</script>

