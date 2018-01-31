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
                        <?
                            use App\Post;
                             $posts = App\Post::all();

                            foreach ($posts as $post) 
                            {
                                echo $post->title;
                            }
                        ?>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection