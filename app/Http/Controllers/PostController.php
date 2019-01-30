<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show the post page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function post()
    {
        return view('pages.posts.post');
    }

    /**
     * Show the category page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category()
    {
        return view('pages.categories.category');
    }

    /**
     * Create a new post and save to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newPost(Request $request)
    {
        return $request->input('title');
    }
}
