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

    <p>{{ $post->body }}</p>


    <h3 class="function-title">Comments</h3>
    @foreach($post->comments as $comment)
    <p>{{$comment->comment}}</p>
    <p><small> by {{$comment->name}}</small></p>
    @endforeach

    <div>
        <form action="{{ route('comments.store', ['post' => $post->id] )}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="function-sub" for="">Comment</label>
                <textarea name="comment" id="" cols="20" rows="10" class="form-control"></textarea>
            </div>
            <button class="btn btn-conu" type="submit">Add Comment</button>
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
