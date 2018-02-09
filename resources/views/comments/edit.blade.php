@extends('layouts.app')

@section('content')

<div class="container">
    <div><small>By {{ $comment->user->fullName() }}</small></div>
    <div>
        <form action="{{ route('comment.update', ['comment' => $comment->id] )}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Edit Coment</label>
                <textarea name="comment" id="" cols="30" rows="10" class="form-control">{{$comment->comment}}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>

</div>

@endsection