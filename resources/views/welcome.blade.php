@extends('layouts.app') @section('content')
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>StackUnderflow</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>


    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Welcome to StackUnderflow
            </div>

            <div class="links">
                <a href="{{ url('/post/create') }}">Create a Post</a>
                <a href="{{ url('/open_posts') }}">Current Posts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
