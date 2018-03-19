@extends('layouts.app') 

@section('content')

<div class ="container">
   <div class = "row">
     <div class = "col-md-8 col-md-offset-2">

        @if(count($errors)>0)
          @foreach($errors->all() as $error)
            <div class = "alert alert-danger">{{$error}}</div>
          @endforeach
        @endif
        @if(session('response'))
           <div class ="alert alert-success"> {{session('response')}} </div>
        @endif

     	 <div class = "panel panel-default">
     	 	 <div class = "panel-heading">Profile</div>
                <div class = "panel-body">
     	 	 
  


                     <form class="form-horizontal" method="POST" action="{{ route('addProfile') }}"enctype = "multipart/form-data">
                        {{ csrf_field()}}



                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="user_name" type="name" class="form-control" name="user_name" value="{{ old('user_name') }}">

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="input" class="form-control" name="title">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                         <div class="form-group{{ $errors->has('profile_pic') ? ' has-error' : '' }}">
                            <label for="profile_pic" class="col-md-4 control-label">Profile picture</label>
                              <div class="col-md-6">
                                <input id="profile_pic" type="file" class="form-control" name="profile_pic">

                                @if ($errors->has('profile_pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_pic') }}</strong>
                                    </span>
                                @endif
                             </div>
                         </div>
               

                        <div class = "form-group">
                          <div class = "col-md-8 col-md-offset-4">
                            <button type = "submit" class ="btn btn-primary">Submit</button>
                         </div>
                       </div>
                    </form>
     	 
     	       </div>
         </div>
    </div>
  </div>
</div>


<html lang="{{ app()->getLocale() }}">
@endsection