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
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                    @foreach($article_users as $article_user)
                    <p class="blog-post-meta">{{ $article_user->name }}</p>
                    @endforeach

                    @foreach($article_tags as $article_tag)
                    <p class="blog-post-meta">{{ $article_tag->tag_name }}</p>
                    @endforeach

                    <hr>
                    @foreach($article_images as $article_image)
                    <img src="{{ $article_image->image_url }}" width="100" height="100">
                    @endforeach
                    <p>{{ $article->body }}</p>
                </div><!-- /.blog-post -->
            </div>
        </div>
    </main>
</div>
</body>
</html>
