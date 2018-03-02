@extends('layouts.app')

@section('content')

<div class="container">
    <div><Strong>Delete this comment?</Strong>
    	<br>
    	<strong>{{$comment->comment}}</strong>
    </div>
    <div>


        <form action="{{ route('comment.destroy', ['comment' => $comment->id] )}}" method="DELETE">
            {{ csrf_field() }}
            <button class="btn btn-primary" type="submit">Delete this comment</button>
        </form>
    </div>

</div>

@endsection