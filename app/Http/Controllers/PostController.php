<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

use Auth;
use App\Category;
use App\Post;

class PostController extends Controller
{
    /**
     * Show the post page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function post()
    {
        $categories = Category::all();
        return view('pages.posts.post', ['categories' => $categories]);
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required',
            'post_img' => 'required',
        ]);

        $posts = new Post;

        if(Auth::check())
        {
            $posts->user_id = Auth::user()->getId();
        }

        $posts->post_title = $request->input('title');
        $posts->post_content = $request->input('content');
        $posts->category_id = $request->input('categories');

        // check file is of type file
        if(Input::hasFile('post_img'))
        {
            // file is type file
            $file = Input::file('post_img');
            // add file to public img folder
            $file->move(public_path() . '/posts',
            $file->getClientOriginalName());
            // append to end of URL
            $url = URL::to("/") . '/posts' . '/' .
            $file->getClientOriginalName();

        }

        $posts->post_img = $url;
        $posts->save();

        return redirect('/home')->with('response', 'Post Published!');
    }

    /**
     * View a full post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view($post_id)
    {
        $posts = Post::where('id', '=', $post_id)->get();
        $categories = Category::all();
        return view('pages.posts.view', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * Edit a post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * Edit a post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id)
    {
        return $id;
    }
}
