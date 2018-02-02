@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Your Post</h2>
    <form action="/post" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Create Post</button>
    </form>
</div>
@endsection
