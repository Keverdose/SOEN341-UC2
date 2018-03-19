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