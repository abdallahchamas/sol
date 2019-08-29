<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function __construct () {
    }

    public function index ()
    {
        $this->authorize('update');
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
        $this->authorize('update');

        return view('posts.create');
    }

    public function store ()
    {
        $this->authorize('update');

        $attributes = $this->validatePost();
        $post = Post::create($attributes + ['owner_id' => auth()->id()]);

        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        $this->authorize('update');

        return view("posts.edit", compact('post'));
    }

    public function update(Post $post)
    {
        $this->middleware('auth');

        $post->update($this->validatePost());

        return redirect("/posts");
    }

    public function destroy(Post $post)
    {
        $this->authorize('update');

        $post->delete();

        return redirect("/posts");
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
}
