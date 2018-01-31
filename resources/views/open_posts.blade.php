@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Dashboard</div>-->

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Currently Open Posts
                    </br>
                        <?php
                            use App\Post;
                            use App\User;

                             $posts = App\Post::all();
                             

                            foreach ($posts as $post) 
                            {
                                echo nl2br ("Title:\n");
                                echo $post->title;
                                echo nl2br ("\nBody:\n");
                                echo $post->body;
                                echo nl2br ("\nAuthor:\n");
                                $user = App\User::where('id', $post->user_id)->first();
                                echo $user->first_name;
                            }
                        ?>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection