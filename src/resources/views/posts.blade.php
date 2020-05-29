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
<script>
    function previewImg(obj) {
        document.getElementById('preview').innerHtml = '<p>プレビュー</p>';
        // 同時選択された分だけ回す
        for (i = 0; i < obj.files.length; i++) {
            var reader = new FileReader();
            reader.onload = (function (e) {
                // previewにimgタグを追加
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
        <a href="{{ route('home') }}">戻る</a><br>
        <label>題名</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="タイトル">
        <label>タグ</label>
        <input type="text" id="tag" name="tags" class="form-control" placeholder="#から始めて、単語をスペースで区切って入力"><br>
        <label>本文</label>
        <textarea id="body" name="body" class="form-control" rows="50" cols="80" placeholder="本文をここに入力"></textarea>
        <label>画像アップロード</label>
        <input type="file" id="up_file" name="up_file[]" accept="image/*" onchange="previewImg(this);" multiple>
        <p id="preview"></p>
        <button name="posts" id="posts" type="submit" class="btn btn-info">投稿</button>
    </form>
</div>
</body>
</html>

