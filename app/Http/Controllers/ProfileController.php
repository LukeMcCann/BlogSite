<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

use Auth;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('pages.profiles.profile');
    }

    public function newProfile(Request $request)
    {
        // return $request->input('name');

        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'profile_img' => 'required'
        ]);

        $profiles = new Profile;

        if(Auth::check())
        {
            $profiles->user_id = Auth::user()->getId();
        }

        $profiles->username = $request->input('name');
        $profiles->title = $request->input('title');

        // check file is of type file
        if(Input::hasFile('profile_img'))
        {
            // file is type file
            $file = Input::file('profile_img');
            // add file to public img folder
            $file->move(public_path() . '/uploads',
            $file->getClientOriginalName());
            // append to end of URL
            $url = URL::to("/") . '/uploads' . '/' .
            $file->getClientOriginalName();

        }

        $profiles->profile_img = $url;
        $profiles->save();
        return redirect('/profile')->with('response', 'Profile Successfully Created.');


    }
}
