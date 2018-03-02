@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Create a New Category</h2>
    <form action="{{ route('categories.store')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
       
        
        <button class="btn btn-primary" type="submit">Create Category</button>
    </form>
</div>

@endsection