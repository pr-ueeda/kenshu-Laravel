<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>kenshu-Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
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

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('home_show') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="container">
                <div class="flex-column">
                    @if(count($article_meta_data) > 0)
                        @foreach($article_meta_data as $article_meta_datum)
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <h3 class="mb-0"><a class="text-dark" href="{{ route('article.show', [$article_meta_datum->id]) }}">
                                                    {{ $article_meta_datum->title }}</a></h3>
                                            <div class="mb-1 text-muted">投稿者 : {{ $article_meta_datum->user->first()->name }}</div>
                                            <div class="mb-1 text-muted">投稿日 : {{ $article_meta_datum->updated_at }}</div>
                                            <div class="col-auto d-none d-lg-block">
                                                <img class="bd-placeholder-img" src="{{ $article_meta_datum->image->first()->image_url }}" width="200" height="250">
                                            </div>
                                            <p class="mb-auto">{{ $article_meta_datum->body }}</p>
                                            <a href="{{ route('article.show', [$article_meta_datum->id]) }}" class="stretched-link">続きを読む</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                </div>
            </div>
        </div>
        @else
            <p>まだ記事がありません。</p>
        @endif
    </body>
</html>
