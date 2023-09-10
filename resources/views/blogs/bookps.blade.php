<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本検索ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h2 class='title'>{{ $blog->book_title }}</h2>
        <a href='/blogs/bookct'>book_create</a>
         <div class='posts'>
            @foreach ($books as $book)
                <div class='post'>
                    <h2 class='title'>{{ $book->title }}</h2>
                    <p class='body'>{{ $book->author }}</p>
                    <p class='body'>{{ $book->front_cover_image_path }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $books->links() }}
        </div>
    </body>
</html>