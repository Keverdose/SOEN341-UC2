@extends('layouts.app')
<style type = "text/css">
    .picture{
            border-radius: 150%;
            width:150px;
            height:150px;}
    
    .group{ position: relative;left: 10%;
          font-family: "Times New Roman", Times, serif;;}

    .user_info{position: relative;left: 10%;
                font: italic bold 12px/30px Georgia, serif}

    #user_name{ font-size: large;}

    #profile{font-size: large;
            }
</style>
@section('content')






                  <div class= "group">
                   @if(!empty($user->profile_pic))
                        <img src ="{{$user->profile_pic}}" class = "picture" alt="" style="float:left">
                        @else
                        <img src ="{{url('images/avatar.jpg')}}" class = "picture" alt="" style= "float:right">
                   @endif



              
                   <ul class = user_info style="list-style-type:none">
                    <li id = user_name>{{$user->user_name}}</li>
                    <li id = title>{{$user->title}}</li>
                    <li>Member since: {{$time}}</li>
                    <li>{{$user->view_count}} profile view</li>
                    @if($user->id == Auth::user()->id)
                    <li><a href= "{{ route('editProfile') }}" id= profile>Edit Profile</a></li>
                    @endif
                   </ul>
                 </div>


                   
                </div>
            </div>
        </div>

@endsection