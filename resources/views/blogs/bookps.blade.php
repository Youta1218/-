<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本検索ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>本検索ページ</h1>
         <div class='posts'>
            @foreach ($books as $book)
                <div class='post'>
                    <h2 class='title1'>{{ $book->title }}</h2>
                    <p class='body1'>{{ $book->author }}</p>
                    <p class='body2'>{{ $book->front_cover_image_path }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $books->links() }}
        </div>
    </body>
</html>