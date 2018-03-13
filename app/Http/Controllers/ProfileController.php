<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Profile;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;


class ProfileController extends Controller
{
    public function profile(){
    	return view('profile.profile');
    }

    public function addProfile(Request $request){
    	$this ->validate($request,[
    		'name' => 'required',
    	  'title' => 'required',
    	  'profile_pic' => 'required',
    	]);

    	$profiles = new Profile;
      $profiles ->user_id = Auth::user()->id;
    	$profiles ->name = $request->input('name');
    	$profiles ->title = $request->input('title');
    	if(Input::hasFile('profile_pic'))
    		{
    	 $file = Input::file('profile_pic');
    	 $file->move(public_path().'/uploads/',$profiles->user_id.'.'.$file->getClientOriginalExtension()); 
    	 $url =URL::to("/").'/uploads/'.$profiles->user_id.'.'.$file->getClientOriginalExtension();
    	    }
            $profiles ->profile_pic = $url;


       $profileCheck = Profile::find($profiles->user_id);
       if($profileCheck!=null){
           $profileCheck ->name = $profiles -> name;
           $profileCheck ->title = $profiles -> title;
           $profileCheck ->profile_pic= $profiles -> profile_pic;
           $profileCheck ->save();
           return redirect('/home')->
           with('response', 'profile was succesfully updated');
         }
        else{
    	$profiles -> save();
    	return redirect('/home')->
    	with('response','Profile Added Successfully');
        }

       }
}
