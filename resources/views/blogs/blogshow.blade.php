<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本投稿ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class='title'>
            {{ $blog->blog_title }}
        </h1>
         <div class='content'>
                <div class='blog_content'>
                    <p class='blog_title'>{{ $blog->blog_title }}</p>
                    <h3>題名</h3>
                    <h2 class='book_title'>{{ $blog->book_title }}</h2>
                    <h3>著者</h3>
                    <p class='author'>{{ $blog->author }}</p>
                    <h3>表紙</h3>
                    <p class='cover'>{{ $blog->front_cover_image_path }}</p>
                    <h3>コメント</h3>
                    <p class='blog_body'>{{ $blog->blog_body }}</p>
                </div>
        </div>
        <div class="edit"><a href="/blogs/{{ $blog->id }}/edit">投稿情報編集</a></div>
       <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>