@extends('layouts.app')

@section('content')
<div class="container removeSidePadding">
    <h1 class="title">Posts</h1>

    <ul>
        @foreach($posts as $post)
            <li>
                <a class="postTitleLink" href="/posts/{{ $post->id }}">
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>

    <form method="GET" action="/posts/create">
        {{ csrf_field() }}
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Post</button>
            </div>
        </div>
    </form>
</div>
@endsection
