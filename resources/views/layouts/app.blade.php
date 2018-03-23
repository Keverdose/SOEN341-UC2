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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    
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
                        <form action="{{ route('post.search')}}" class="form-inline" method="get">
                            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <div class="top-right linkstwo">
                    
                       @auth
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/post/create') }}">Create a Post</a>
                        <a href="{{ url('/open/posts') }}">View Open Posts</a>
                        <a href="{{ url('/solved/posts') }}">View Solved Posts</a>
                        <a href="{{ url( route('user.activity', ['user_id' => Auth::id()])) }}">My Posts</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        

                        <a href="{{url('profile', Auth::user())}}">
                        <?php $user = Auth::user();?>
                        @if(!empty($user->profile_pic))
                        <img src ="{{$user->profile_pic}}" class = "avatars" alt="" >
                        @else
                        <img src ="{{url('images/avatar.jpg')}}" class = "avatars" alt="">
                        @endif
                        </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a> 
                        @endauth
                       
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
      $(document).ready(function(){
          $('.select2-multi').select2();
          $(".select2-multi").select2({
            tags: true
            });
       });
    </script>
</body>

</html>
