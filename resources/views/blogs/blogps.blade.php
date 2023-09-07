<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本投稿ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>本投稿ページ</h1>
         <div class='posts'>
            @foreach ($blogs as $blog)
                <div class='post'>
                    <h2 class='title1'>{{ $blog->book_title }}</h2>
                    <p class='body1'>{{ $blog->author }}</p>
                    <p class='body2'>{{ $blog->front_cover_image_path }}</p>
                    <h2 class='title2'>{{ $blog->blog_title }}</h2>
                    <p class='body3'>{{ $blog->blog_body }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $blogs->links() }}
        </div>
    </body>
</html>