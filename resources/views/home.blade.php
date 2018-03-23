<<<<<<< HEAD
<<<<<<< HEAD
@extends('layouts.main')
<style type = "text/css">
    .avatar{
            border-radius: 50%;
            max-width:50px;
            }
</style>
=======
@extends('layouts.app')

>>>>>>> parent of 5148e96... Merge branch 'master' into 69-Open-Post-Page-Filter
=======
@extends('layouts.app')

>>>>>>> parent of 5148e96... Merge branch 'master' into 69-Open-Post-Page-Filter
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                        {{ session('status') }}
                        </div>
                    @endif

                    {{ $user->fullName() }} are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
