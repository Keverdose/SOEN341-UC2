@extends('layouts.app')

@section('content')

<div class="container">
     <div><Strong>Delete this post?</Strong>
        <br>
        <strong>{{$post->body}}</strong>
    </div>
    <div>


        <form action="{{ route('post.destroy', ['post' => $post->id] )}}" method="DELETE">
            {{ csrf_field() }}
            <button class="btn btn-primary" type="submit">Delete this post</button>
        </form>
    </div>

</div>

@endsection