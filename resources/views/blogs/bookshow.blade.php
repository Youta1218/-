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
            {{ $blog->book_title }}
        </h1>
         <div class='content'>
                <div class='blog_content'>
                    <h3>題名</h3>
                    <h2 class='title'>{{ $blog->book_title }}</h2>
                    <h3>著者</h3>
                    <p class='body'>{{ $blog->author }}</p>
                    <h3>表紙</h3>
                    <p class='body'>{{ $blog->front_cover_image_path }}</p>
                </div>
        </div>
       <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>