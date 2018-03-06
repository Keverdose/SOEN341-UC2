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
            <label for="">Category</label>
            @if($categories->count() != 0)
            <select class="form-control" name="Category">
                @foreach($categories as $category)
                <option name ="category_id" value={{$category->id}}>{{$category->name}}</option>
                @endforeach
            </select>
            @endif
            <br>
             <a href="{{ url('/post/create/createCategory') }}" class="btn btn-xs btn-info pull-left" >Create a new category</a>
            
        </div>
        <br>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Create Post</button>
    </form>
</div>
@endsection
