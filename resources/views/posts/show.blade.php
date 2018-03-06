@extends('layouts.app')

@section('content')

<div class="container">
    <div><small>By {{ $post->user->fullName() }}</small></div>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
    <p>Posted in: {{$post->category->name}}</p>
    @if(Auth::id()==$post->user_id and $post->solved==FALSE)
        <a href="{{ route('post.edit', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left" >Edit</a>
        <a href="{{ route('post.delete', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left">Delete</a>
        <br>
    @elseif(Auth::id()==$post->user_id and $post->solved==TRUE)
        <a href="{{ route('post.reopen', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left" >Reopen Post</a>
    @endif

    <br>
    <h3>Comments</h3>

    @foreach($post->comments as $comment)
    <h4>{{$comment->name}} commented: </h4>
    <p>{{$comment->comment}}</p>
    <p>Last Edit: {{mb_substr($comment->updated_at, 0, 10)}}</p>

        @if(Auth::id()==$comment->user_id)
            <a href="{{ route('comment.edit', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left">Edit</a>
            <a href="{{ route('comment.delete', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left">Delete</a>
        @endif

        @if(Auth::id()==$post->user_id and $post->solved==FALSE)
            <a href="{{ route('comment.answer', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left">Best Answer</a>
        @endif
        <br>
    @endforeach

    <div>
        <form action="{{ route('comments.store', ['post' => $post->id] )}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="">Comment</label>
                <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Add Comment</button>
        </form>
    </div>
</div>
@endsection