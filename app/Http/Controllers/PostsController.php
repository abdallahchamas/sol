<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsController extends Controller
{
    public function __construct () {
    }

    public function index ()
    {
        $this->authRequired();

        $posts = auth()->user()->posts;

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->prepareForDisplay();

        return view("posts.show", compact('post'));
    }

    public function create ()
    {
        $this->authRequired();

        return view('posts.create');
    }

    public function store ()
    {
        $this->authRequired();

        $attributes = $this->validatePost();

        $post = Post::create($attributes + ['owner_id' => auth()->id()]);

        return redirect('/posts')->with('success', 'Post created');
    }

    public function edit(Post $post)
    {
        $this->authRequired();

        return view("posts.edit", compact('post'));
    }

    public function update(Post $post)
    {
        $this->middleware('auth');

        $post->update($this->validatePost());

        return redirect("/posts")->with('success', 'Post updated');
    }

    public function destroy(Post $post)
    {
        $this->authRequired();

        $post->delete();

        return redirect("/posts")->with('success', 'Post deleted');
    }

    protected function validatePost () {
        return request()->validate([
            'title' => [ 'required', 'min:3', 'max:255' ],
            'description' => [ 'required', 'min:3' ]
        ]);
    }

    public function displayAll () {
        $posts = Post::all()->each(function ($post) {
            $post->prepareForDisplay();
        });

        return view('posts.displayAll', compact('posts'));
    }

    private function authRequired () {
        abort_if(is_null(auth()->user()) || ! auth()->user()->isAdmin(), 403);
    }
}
