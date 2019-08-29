@extends('layouts.app')

@section('content')
<div class="container removeSidePadding">
    <h1 class="title">Create a New Post</h1>

    <form method="POST" action="/posts">
        {{ csrf_field() }}

        <div class="field">
            <div class="control">
                <label class="label" for="title">Title</label>

                <input name="title" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" placeholder="Post title" value="{{ old('title') }}" required />
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Content</label>

            <div class="control">
                <textarea name="description" class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}" placeholder="Post content" required>{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Post</button>
            </div>
        </div>

        @include('errors')
    </form>
</div>
@endsection
