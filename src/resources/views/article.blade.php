<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>kenshu-Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
<div class="container">
    <main role="main" class="container">
        <div class="col-md-8 blog-main">
            <div class="d-flex">
                @if(count($article_data) > 0)
                    @foreach($article_data as $article_datum)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $article_datum->title }}</h2>
                    <p class="blog-post-meta">{{ $article_datum->name }}</p>
                    <p class="blog-post-meta">{{ $article_datum->tag_name }}</p>
                    <hr>
                    <img src="{{ $article_datum->image_url }}" width="100" height="100">
                    <p>{{ $article_datum->body }}</p>
                </div><!-- /.blog-post -->
                    @endforeach
                @endif
            </div>
        </div>
    </main>
</div>
</body>
</html>
