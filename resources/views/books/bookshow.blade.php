<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本情報</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class='title'>
            {{ $book->title }}
        </h1>
         <div class='content'>
                <div class='book_content'>
                    <h3>題名</h3>
                    <h2 class='title'>{{ $book->title }}</h2>
                    <h3>作者</h3>
                    <p class='author'>{{ $book->author }}</p>
                    <h3>表紙</h3>
                    <p class=cover>{{ $book->front_cover_image_path }}</p>
                    <h3>本の場所</h3>
                    <p class='place'>{{ $book->place }}</p>
                    <h3>カテゴリー</h3>
                    <p class='category'>{{ $book->category }}</p>
                    <h3>シリーズ名</h3>
                    <p class='series'>{{ $book->series }}</p>
                    <h3>本棚</h3>
                    <p class='bookshelf'>{{ $book->bookshelf_image_path }}</p>
                </div>
        </div>
        <div class="edit"><a href="/books/{{ $book->id }}/bookedit">本情報編集</a></div>
       <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>