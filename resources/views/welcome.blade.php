@extends('layouts.app') @section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>StackUnderflow</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">

        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Welcome to StackUnderflow
            </div>

            <div class="links">
                <a href="{{ url('/post/create') }}">Create a Post</a>
                <a href="{{ route('posts.list', ['status' => 'open'])}}">Current Posts</a>
                <a href="{{ route('posts.list', ['status' => 'solved'])}}">Solved Posts</a>
                <a href="{{ route('user.activity', ['user_id' => Auth::id()])}}">My Activity</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
