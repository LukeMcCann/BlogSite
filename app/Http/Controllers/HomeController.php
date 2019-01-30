<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Profile;
use App\User;
use App\Post;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function home()
     {
         $user_id = Auth::user()->id;
         // get user table and join via id's
         $profile = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         // select all users and all profiles
         ->select('users.*', 'profiles.*')
         // where id => $this.id
         ->where(['profiles.user_id' => $user_id])
         ->first();

         $posts = Post::all();
         return view('pages.home', ['profile' => $profile, 'posts' => $posts]);
     }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.index');
    }
}
