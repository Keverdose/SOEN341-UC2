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

                    {{ Form::open() }}
                    Title:
                    <br/> {{ Form::textarea('post_title', null, ['size' => '50x1']) }}

                    <br/> Description of issue:
                    <br/> {{ Form::textarea('post_description', null, ['size' => '80x15']) }}

                    <br/> Tags:
                    <br/> {{ Form::text('post_tags', null, ['size' => '60x1']) }}
                    {{ Form::close() }}
                    <br/> {{ Form::submit('Submit', array('class' => 'btn')) }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
