<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 70px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height backgroundAliceBlue" id="mainPage">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        @if (Route::has('register') && (App\User::all()->count() == 0))
                            <a href="{{ route('register') }}">Register</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content backgroundAliceBlue">
                <div class="container removeSidePadding">
                    <div class="container">
                        @if (App\User::all()->count() == 0)
                            <h1 class="title center">Register to start your blog</h1>
                        @else
                            <h1 class="title">{{ App\User::first()->name }}'s Blog</h1>
                        @endif
                    </div>

                    <div class="container">
                        @foreach($posts as $post)
                            <div class="post">
                                <a class="postTitleLink" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                                <p class="readablePost">{!! $post->displayableContent !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>