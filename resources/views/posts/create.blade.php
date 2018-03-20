@extends('layouts.main') 
@section('stylesheets')
{!! Html::style('css/select2.min.css') !!}

@endsection
@section('content')
<div class="container wrap-rob">
    <h2>Create Your Post</h2>
    
    <form action="/post" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
                <div class="form-group">
    <label for="tags">Tags</label>
      <select class="form-control select2-multi" name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{$tag->name}}">{{$tag->name}}</option>
            @endforeach
        </select>
</div>


       

        <div class="form-group">
            <label for="">Category</label>
            @if($categories->count() != 0)
            <select class="form-control" name="Category" required>
                @foreach($categories as $category)
                <option name ="category_id" value={{$category->id}}>{{$category->name}}</option>
                @endforeach
            </select>
            @endif
            
        </div>
        <br>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Create Post</button>
    </form>
</div>
@endsection
@section('scripts')
{!! Html::script('js/select2.min.js') !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="test/javascript">
    $('.select2-multi').select2();
    </script>
@endsection