@extends('layouts.app')

@section('content')

<div class="container">
    <div><small>By {{ $post->user->fullName() }}</small></div>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}}</p>
    <h3>Comments</h3>
    @foreach($post->comments as $comment)
    <h4>{{$comment->name}} commented: </h4>
    <p>{{$comment->comment}}</p>
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