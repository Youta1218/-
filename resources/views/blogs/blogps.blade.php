<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本投稿ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <a href='/blogs/blogct'>blog_create</a>
         <div class='posts'>
            @foreach ($blogs as $blog)
                <div class='post'>
                    <h2 class='title'>{{ $blog->blog_title }}</h2>
                    <h2 class='blog_title'>{{ $blog->book_title }}</h2>
                    <p class='author'>{{ $blog->author }}</p>
                    <p class='cover'>{{ $blog->front_cover_image_path }}</p>
                    <p class='blog_body'>{{ $blog->blog_body }}</p>
                    <p class='category'>{{ $blog->category_id }}</p>
                    <p class='series'>{{ $blog->series_id }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $blogs->links() }}
        </div>
    </body>
</html>