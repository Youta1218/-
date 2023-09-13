<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本検索ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <a href='/books/bookct'>book_create</a>
         <div class='posts'>
            @foreach ($books as $book)
                <div class='post'>
                    <a href="/books/{{ $book->id }}">{{ $book->front_cover_image_path }}</a>                    
                    <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $books->links() }}
        </div>
    </body>
</html>