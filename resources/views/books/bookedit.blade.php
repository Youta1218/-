<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>登録変更</title>
    </head>
    <body>
        <h1>本登録情報編集</h1>
        <form action="/books" method="BOOK">
            @csrf
            @method('PUT')
            <div class="book_inf">
                <h2>本情報</h2>
                <h4>題名</h4>                
                <input type='text' name='book[title]' value="{{ $book->title }}">
                <h4>作者</h4> 
                <input type='text' name='book[author]' value="{{ $book->author }}">
                <h3>表紙</h3>
                <input type='text' name='book[front_cover_image_path]' value="{{ $book->front_cover_image_path }}">
                <h4>本の場所</h4> 
                <input type='text' name='bookshelf[place]' value="{{ $book->bookshelf->place }}">
                <h4>カテゴリー</h4> 
                <input type='text' name='category[name]' value="{{ $book->category->name }}">
                <h4>シリーズ</h4> 
                <input type='text' name='series[name]' value="{{ $book->series->name }}">
                
                
                
            </div>
            <div class="body">
               
                
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>