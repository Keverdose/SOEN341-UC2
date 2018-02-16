@extends('layouts.app') @section('content')

<div class="container">

    <h1 class="function-title">{{ $post->title }}</h1>
    <div class="function-sub"><small>By {{ $post->user->fullName() }}</small></div>
    <br>
    <br>
    <p>{{ $post->body }}}</p>
    @if(Auth::id()==$post->user_id)
        <a href="{{ route('post.edit', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left" >Edit</a>
         <a href="{{ route('post.delete', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left">Delete</a>
        <br>
    @endif

    <h3 class="function-title">Comments</h3>
    @foreach($post->comments as $comment)
    <p>{{$comment->comment}}</p>

    <p><small> by {{$comment->name}}</small></p>


        @if(Auth::id()==$comment->user_id)
            <a href="{{ route('comment.edit', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left">Edit</a>
             <a href="{{ route('comment.delete', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left">Delete</a>
            <br>
        @endif

    @endforeach

    <div>
        <form action="{{ route('comments.store', ['post' => $post->id] )}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="function-sub" for="">Comment</label>
                <textarea name="comment" id="" cols="10" rows="10" class="form-control"></textarea>
            </div>
            <button class="btn btn-conu" type="submit">Add Comment</button>
        </form>
    </div>

</div>

@endsection
