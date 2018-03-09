@extends('layouts.app')

@section('content')

    <!-- Styles -->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h2>Currently Open Posts</h2>
    </br>

    @foreach($posts as $post)
        <?php
            $numberOfComments = count($post->comments);
            $numberOfViews = $post->view_count;
        ?>
            <div class ="row" >
                <div class="col-sm-1">
                    <span class = "nb-of-Comments-Block "style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfComments }}</a>
                        </br>
                    Comments</span>
                </div>

                <div class="col-sm-1">
                    <span style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">N/A</a>
                        </br>
                        Votes</span>
                </div>

                <div class="col-sm-1">
                    <span class = "nb-of-Comments-Block "style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfViews }}</a>
                        </br>
                        Views</span>
                </div>

                <div class="col-sm-9" >
                    <span style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">

                    <a href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a>
                    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
                        </span>
                </div>
            </div>
    <!-- Votes -->
    <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'up'])}}">
        {{csrf_field()}}
        <button>Upvote</button>
    </form>
    <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'down'])}}">
        {{csrf_field()}}
        <button>Downvote</button>
    </form>
    <!-- End Votes -->
    @endforeach

</div>
@endsection