@extends('layouts.app') @section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h1 class="function-title">Currently Open Posts</h1>
    </br>

    @foreach($posts as $post)
    <h2><a class="function-sub" href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a></h2>
    <div><small>By {{ $post->user->fullName() }}</small></div>
    <br>
    <p>{{ $post->body }}</p>


    <h3 class="function-title">Comments</h3>
    @foreach($post->comments as $comment)
            <h4>{{$comment->name}} commented: </h4>
            <p>{{$comment->comment}}</p>
    @endforeach

    

    @endforeach

</div>
@endsection
