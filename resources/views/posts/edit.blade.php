@extends('layouts.app')

@section('content')
<div class="container removeSidePadding">
    <h1 class="title">Edit Post</h1>

    <form method="POST" action="/posts/{{ $post->id }}" style="margin-bottom: 1em;">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="field">
            <label class="label" for="title">Title</label>

            <div>
                <input type="text" class="input" name="title" placeholder="Title" value="{{ $post->title }}" />
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Content</label>

            <div>
                <textarea class="textarea" name="description">{{ $post->description }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Post</button>
            </div>
        </div>
    </form>

    @include('errors')

    <form method="POST" action="/posts/{{ $post->id }}">
        @method('DELETE')
        @csrf

        <div class="field">
            <div class="control">
                <button type="submit" class="button">Delete Post</button>
            </div>
        </div>
    </form>
</div>
@endsection
