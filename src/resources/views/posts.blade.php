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
    function upload_file() {
        var formdata = new FormData($('#upload_form').get(0))

        $.ajax({
            url  : "/features/article/upload.php",
            type : "POST",
            data : formdata,
            cache       : false,
            contentType : false,
            processData : false,
            dataType    : "html"
        }).done(function(data, textStatus, jqXHR) {
            $('.uploaded_images').append('<img src="' + data + '" width="100" height="100">');
        });
    }
</script>
<div class="container">
    <form method="POST">
        @csrf
        <a href="{{ route('home') }}">戻る</a><br>
        <label>題名</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="タイトル">
        <label>タグ</label>
        <input type="text" id="tag" name="tags" class="form-control" placeholder="#から始めて、単語をスペースで区切って入力"><br>
        <label>本文</label>
        <textarea id="body" name="body" class="form-control" rows="50" cols="80" placeholder="本文をここに入力"></textarea>
        <label>画像アップロード</label>
        <input type="file" id="up_file" name="up_file" >
        <button type="submit">アップロード</button>
        <button name="posts" id="posts" type="submit" class="btn btn-info">投稿</button>
    </form>
    @isset($filename)
    <div class="uploaded_images">
        <img src="{{ asset('public/images/' . $filename) }}">
    </div>
    @endisset
</div>
</body>
</html>

