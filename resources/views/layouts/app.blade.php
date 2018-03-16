<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>StackUnderflow</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top nav-background ">
            <div class="container">
                <div class="navbar-header">



                    <!-- Branding Image -->
                    <a class="navbar-brand  nav-title" href="{{ url('/') }}">
                        <span class="function-sub ">S</span>tack<span class="function-sub">U</span>nderflow
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <div class="top-middle">
                        <form class="form-inline" method="post">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-conu btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <div class="top-right linkstwo">
                        @auth
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/post/create') }}">Create a Post</a>
                        <a href="{{ url('/open/posts') }}">View Open Posts</a>
                        <a href="{{ url( route('user.activity', ['user_id' => Auth::id()])) }}">My Posts</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>






                        @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a> @endauth
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
        </br>
        </br>

        <footer class="footer-bottom">
            <p> &#169;All rights reserved by StackUnderflow </p>


        </footer>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
