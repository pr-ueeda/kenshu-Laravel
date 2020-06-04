@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <main role="main" class="container">
            <table class="table table-hover table-condensed settinglist">
                <thead>
                <tr class=" hidden-xs">
                    <th>タイトル</th>
                    <th>作成日</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user_articles as $user_article)
                <tr class="hidden-xs-down">
                    <td><p>{{ $user_article->title }}</p></td>
                    <td>{{ $user_article->updated_at }}</td>
                    <td><a href="{{ route('article_edit', [$user_article->article_id]) }}">編集</a></td>
                    <td><a href="{{ route('article_delete', [$user_article->article_id]) }}">削除</a></td><br>
                </tr>
                @endforeach
                </tbody>
            </table>
        </main>
    </div>
</div>
@endsection
