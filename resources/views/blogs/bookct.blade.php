<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Book</title>
    </head>
    <body>
        <h1>Book</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="book[book_title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('book.book_title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="book[book_body]" placeholder="今日も1日お疲れさまでした。"></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('book.book_body') }}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>