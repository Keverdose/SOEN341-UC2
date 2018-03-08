@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h2>Currently Open Posts</h2>
    </br>

    @foreach($posts as $post)
    <h3><a href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a></h3>
    <p>{{ $post->body }}</p>
    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>

    <!-- Votes -->
    <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'up'])}}">
        {{csrf_field()}}
        <button>Upvote</button>
    </form>
    <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'down'])}}">
        {{csrf_field()}}
        <button>Downvote</button>
    </form>
    <!-- End Votes -->


    <h3>Comments</h3>

        @foreach($post->comments as $comment)
            <h4>{{$comment->name}} commented: </h4>
            <p>{{$comment->comment}}</p>
            <!-- Votes for comments -->
            <form action="{{route('comment.vote', ['comment' => $comment->id, 'vote' => 'up'])}}">
                {{csrf_field()}}
                <button>Upvote</button>
            </form>
            <form action="{{route('comment.vote', ['comment' => $comment->id, 'vote' => 'down'])}}">
                {{csrf_field()}}
                <button>Downvote</button>
            </form>
            <p>Votes: {{$comment->countVotes()}}</p>
            <!-- End Votes -->
            <p>Last Edit: {{mb_substr($comment->updated_at, 0, 10)}}</p>
        @endforeach
    @endforeach
</div>
@endsection