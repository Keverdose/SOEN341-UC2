@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h2>{{Auth::user()->fullName()}} Posts</h2>
    </br>

    @foreach($posts as $post)
    <h3><a href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a></h3>
    <p>{{ $post->body }}</p>
    @endforeach

    </br>
    <h2>{{Auth::user()->fullName()}} Comments</h2>
    </br>

    @foreach($comments as $comment)
    <p><a href="{{route('post.show', ['post' => $comment->post_id])}}">{{ $comment->comment }}</a></p>
    @endforeach

</div>
@endsection