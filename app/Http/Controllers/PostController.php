<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
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
}
