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

<!--        {{Form::open(['route'=>['comments.store',$post->id,'method'=>'POST']])}}-->
<!--            {{Form::label('comment',"Comment:")}}-->
<!--            {{Form::textarea('comment',null,['class' =>'form-control'])}}-->
<!--            {{Form::submit('Add Comment')}}-->
<!--        {{Form::close()}}-->
        </div>
    @endforeach

</div>
@endsection