@extends('layouts.app')
@section('content')

<div class="container ">
    <div class="col-sm-11">
  

                 <ul class = "user_stats" style="list-style-type:none">  
                    <li>Member since: {{$time}}</li>
                    <li>{{$user->view_count}} profile views</li>
                    <li>Number of posts: {{count($posts)}}</li>
                    <li>Number of answers: {{count($comments)}}</li>
                 </ul>


                    @if($user->id == Auth::user()->id)
                    <a href= "{{ route('editProfile') }}"id= profile>Edit Profile</a>
                    @endif


                    @if(!empty($user->profile_pic))
                    <img src ="{{$user->profile_pic}}" class = "picture" alt="" style="float:left">
                    @else
                    <img src ="{{url('images/avatar.jpg')}}" class = "picture" alt="" style= "float:left">
                    @endif


                  <ul class = user_info style="list-style-type:none">
                    <li id = user_name>User name:  {{$user->user_name}}</li>
                    <li id = title>Title:  {{$user->title}}</li>
                    <li>About me:</li>
                    <li><pre id="about_me">{{$user->about_me}}</pre></li>
                 </ul>
          
   </div>
</div>

@endsection