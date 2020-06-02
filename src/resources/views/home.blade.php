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
                    <th class="center">編集</th>
                    <th class="center">削除</th>
                </tr>
                </thead>
                <tbody>
                <tr class="hidden-xs-down">
                    @foreach($user_articles as $user_article)
                        <td><p>{{ $user_article->title }}</p></td>
                        <td>{{ $user_article->created_at }}</td>
                        <td><a href="{{ route('article_edit', [$user_article->id]) }}">編集</a></td>
                        <td><a href="{{ route('article_delete', [$user_article->id]) }}">削除</a></td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </main>
    </div>
</div>
@endsection
