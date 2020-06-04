@extends('layouts.app')

@section('content')
<body>
<script>
    function previewImg(obj) {
        document.getElementById('preview').innerHtml = '<p>プレビュー</p>';
        // 同時選択された分だけ回す
        for (i = 0; i < obj.files.length; i++) {
            var reader = new FileReader();
            reader.onload = (function (e) {
                // previewにimgタグを追加して表示
                document.getElementById('preview').innerHTML
                    += '<img src="' + e.target.result + '" height="100" width="100">';
            });
            reader.readAsDataURL(obj.files[i]);
        }
    }
</script>
<div class="container">
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <label>題名</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="タイトル">
        @if($errors->has('title'))
        <div>
            <strong>{{ $errors->first('title') }}</strong>
        </div><br>
        @endif
        <label>タグ</label>
        <input type="text" id="tag" name="tags" class="form-control" placeholder="#から始めて、単語をスペースで区切って入力">
        @if($errors->has('tags'))
            <div>
                <strong>{{ $errors->first('tags') }}</strong>
            </div><br>
        @endif
        <label>本文</label>
        <textarea id="body" name="body" class="form-control" rows="50" cols="80" placeholder="本文をここに入力"></textarea>
        @if($errors->has('body'))
            <div>
                <strong>{{ $errors->first('body') }}</strong>
            </div><br>
        @endif
        <label>画像アップロード</label>
        <input type="file" id="up_file" name="up_file[]" accept="image/*" onchange="previewImg(this);" multiple>
        <p>一番最初に選択した画像が記事のサムネイルに設定されます。</p>
        @if($errors->has('up_file'))
            <div>
                <strong>{{ $errors->first('up_file') }}</strong>
            </div><br>
        @endif
        <p id="preview"></p>
        <button name="posts" id="posts" type="submit" class="btn btn-info">投稿</button>
    </form>
</div>
</body>
@endsection
