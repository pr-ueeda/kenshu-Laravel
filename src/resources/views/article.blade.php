@extends('layouts.app')

@section('content')
<body>
<div class="container">
    <main role="main" class="container">
        <div class="col-md-8 blog-main">
            <div class="d-flex">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                    @foreach($article_users as $article_user)
                    <p class="blog-post-meta">投稿者 : {{ $article_user->name }}</p>
                    @endforeach

                    @foreach($article_tags as $article_tag)
                    <p class="blog-post-meta badge badge-secondary badge-pill text-success">・{{ $article_tag->tag_name }}</p>
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
@endsection
