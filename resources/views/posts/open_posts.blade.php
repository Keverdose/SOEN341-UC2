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
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->body }}</p>
    @endforeach

</div>
@endsection