<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Category;
use App\Post;
use App\Like;

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
     * Show posts of specific category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categoryChange($category_id)
    {
        $categories = Category::all();
        $posts = DB::table('posts')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('posts.*', 'categories.*')
        ->where(['categories.id' => $category_id])
        ->get();

        return view('pages.categories.categoryposts', [
            'categories' => $categories,
            'posts' => $posts
        ]);
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
        $likePost = Post::find($post_id);
        $likeCounter = Like::where(['post_id' => $likePost->id])->get();
        $categories = Category::all();
        return view('pages.posts.view', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * Show edit view for post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($post_id)
    {
        $categories = Category::all();
        $posts = Post::find($post_id);
        $category = Category::find($posts->category_id);
        return view('pages.posts.edit', [
            'categories' => $categories,
            'posts' => $posts,
            'category' => $category
        ]);
    }

    /**
     * Update database with new post data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editPost(Request $request, $post_id)
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
        $data = array(
            'post_title' => $posts->post_title,
            'user_id' => $posts->user_id,
            'post_content' => $posts->post_content,
            'category_id' => $posts->category_id,
            'post_img' => $posts->post_img,

        );
        Post::where('id', $post_id)->update($data);
        $posts->update();
        return redirect('/home')->with('response', 'Update Successful!');
    }

    /**
     * Delete a post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($post_id)
    {
        Post::where('id', $post_id)->delete();
        return redirect('/home')->with('response', 'Post Deleted!');
    }
}
