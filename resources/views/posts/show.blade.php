@extends('layouts.app')

@section('content')
<div class="container removeSidePadding">
    <h1 class="title">{{ $post->title }}</h1>

    <div class="content">
        <p class="readablePost">
        	{!! $post->displayableContent !!}
        </p>
        @if (auth()->check())
        <p>
            <a class="actionLink" href="/posts/{{ $post->id }}/edit">Edit</a>
        </p>
        @endif
    </div>
</div>
@endsection
