<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Profile;
use App\Category;
use App\Comment;
use App\Post;
use App\Like;
use App\Dislike;

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
     * View comment page for post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function comment(Request $request, $post_id)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->getId();
        $comment->post_id = $post_id;
        $comment->comment = $request->input('comment');
        $comment->save();
        return redirect('/view' . '/' . $post_id)
        ->with('response', "Comment Posted!");
    }

    /**
     * View a full post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view($post_id)
    {
        $posts = Post::where('id', '=', $post_id)->get();
        $likePost = Post::findOrFail($post_id);
        $likeCounter = Like::where(['post_id' => $likePost->id])->count();
        $dislikeCounter = Dislike::where(['post_id' => $likePost->id])->count();
        $categories = Category::all();
        $comments = DB::table('users')
        ->join('comments', 'users.id', '=', 'comments.user_id')
        ->join('posts', 'comments.post_id', '=', 'posts.id')
        ->select('users.name', 'comments.*')
        ->where(['posts.id' => $post_id])
        ->get();

        return view('pages.posts.view', [
            'posts' => $posts,
            'categories' => $categories,
            'likeCounter' => $likeCounter,
            'dislikeCounter' => $dislikeCounter,
            'comments' => $comments
        ]);
    }

    /**
     * Add likes to a post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function like($id)
    {
        $user = Auth::user()->getid();
        $liking_user = Like::where([
            'user_id' => $user,
            'post_id' => $id
        ])
        ->first();

        if(empty($liking_user->user_id))
        {
            $user_id = Auth::user()->id;
            $post_id = $id;
            $email = Auth::user()->id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect('/view' . '/' . $id);
        }
        return redirect('/view' . '/' . $id);
    }

    /**
     * Add dislikes to a post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dislike($id)
    {
        $user = Auth::user()->getid();
        $disliking_user = Dislike::where([
            'user_id' => $user,
            'post_id' => $id
        ])
        ->first();

        if(empty($disliking_user->user_id))
        {
            $user_id = Auth::user()->id;
            $post_id = $id;
            $email = Auth::user()->id;
            $dislike = new Dislike;
            $dislike ->user_id = $user_id;
            $dislike ->email = $email;
            $dislike ->post_id = $post_id;
            $dislike ->save();
            return redirect('/view' . '/' . $id);
        }
        return redirect('/view' . '/' . $id);
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

    public function search(Request $request)
    {
        if(Auth::check())
        {
            $user_id = Auth::user()->getId();
        }

        $profile = Profile::find($user_id);
        $searchphrase = $request->input('search');
        $posts = Post::where('post_title', 'LIKE', '%' .$searchphrase. '%')->get();
        return view('pages.posts.searched', [
            'profile' => $profile,
            'posts' => $posts
        ]);
    }
}
