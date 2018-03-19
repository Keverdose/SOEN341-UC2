@extends('layouts.app') @section('content')

<div class="container ">
    <div><small>By {{ $post->user->fullName() }}</small></div>
    <h1 class="post-title">{{ $post->title }}</h1>
    <div class="col-sm-1">
         <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'up'])}}">
        {{csrf_field()}}
        <button class="updownVoteButton">
         <img src="{{URL::asset('/images/up_arrow.png')}}"  /></button>
    </form>
    <p class="votecount">{{$post->countVotes()}}</p>
    <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'down'])}}">
        {{csrf_field()}}
        <button class="updownVoteButton"><img src="{{URL::asset('/images/down_arrow.png')}}"  /></button>
    </form>
    
    </div>
    <div class="col-sm-11">
    <p>{{ $post->body }}</p>
    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
    <p>Posted in: {{$post->category->name}}</p>
     @foreach($post->tags as $tag)
                      <label class ="tags">{{$tag->name}}</label>
                    @endforeach
                    <br>
    @if(Auth::id()==$post->user_id and $post->solved==FALSE)


        <a href="{{ route('post.edit', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left edit-delete" >Edit</a>
        <a href="{{ route('post.delete', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left edit-delete">Delete</a>
        <br>
    @elseif(Auth::id()==$post->user_id and $post->solved==TRUE)
        <a href="{{ route('post.reopen', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left edit-delete" >Reopen Post</a>
    @endif

</div>
    <br>

    

<div class="col-sm-1">   </div>
<div class="col-sm-11">
 <h3 >Comments</h3>


    @foreach($post->comments as $comment)


        @if($comment->user_name != null)
            <h4>commented:<a href="{{route('profile', ['profile'=>$comment->user_id])}}">
                           {{$comment->user_name}}</a></h4>
        @else
            <h4>commented:<a href="{{route('profile', ['profile'=>$comment->user_id])}}">
                           {{$comment->name}}</a> </h4>
        @endif
  
        <p>{{$comment->comment}}</p>
        <p>Last Edit: {{mb_substr($comment->updated_at, 0, 10)}}</p>
 

    <div class="col-sm-12">
    <h4 class="post-title">{{$comment->name}} commented: </h4>
</div>
    <div class="col-sm-1"> 

     <!-- Votes for comments -->
    <form action="{{route('comment.vote', ['comment' => $comment->id, 'vote' => 'up'])}}">
        {{csrf_field()}}
         <button class="updownVoteButton"><img src="{{URL::asset('/images/up_arrow.png')}}"  /></button>
    </form>
     <p class="votecount">{{$comment->countVotes()}}</p>
    <form action="{{route('comment.vote', ['comment' => $comment->id, 'vote' => 'down'])}}">
        {{csrf_field()}}
         <button class="updownVoteButton"><img src="{{URL::asset('/images/down_arrow.png')}}"  /></button>
    </form>
   
    <!-- End Votes -->

</div>
<div class="col-sm-11">
    <p>{{$comment->comment}}</p>

   

    <p>Last Edit: {{mb_substr($comment->updated_at, 0, 10)}}</p>

        @if(Auth::id()==$comment->user_id)
            <a href="{{ route('comment.edit', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left edit-delete">Edit</a>
            <a href="{{ route('comment.delete', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left edit-delete">Delete</a>
        @endif

        @if(Auth::id()==$post->user_id and $post->solved==FALSE)
            <a href="{{ route('comment.answer', ['comment' => $comment->id])}}" class="btn btn-xs btn-info pull-left edit-delete">Best Answer</a>
        @endif
        <br>
        </div>
    @endforeach

<div class="col-sm-12">
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
   </div>
</div>

@endsection

