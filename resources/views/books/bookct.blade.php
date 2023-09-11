<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Book</title>
    </head>
    <body>
        <h1>本登録</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="book_inf">
                <h2>本情報</h2>
                <h4>題名</h4>                
                <input type="text" name="book[title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                <h4>作者</h4> 
                <textarea name="book[author]" placeholder="作者"></textarea>
                <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                <h4>本の場所</h4> 
                <textarea name="book[place]" placeholder="一段目"></textarea>
                <p class="place__error" style="color:red">{{ $errors->first('book.place') }}</p>
                <h4>カテゴリー</h4> 
                <textarea name="book[category]" placeholder="小説"></textarea>
                <p class="category__error" style="color:red">{{ $errors->first('book.category') }}</p>
                <h4>シリーズ</h4> 
                <textarea name="book[series]" placeholder="シリーズ名"></textarea>
                <p class="series__error" style="color:red">{{ $errors->first('book.series') }}</p>
                
                
            </div>
            <div class="body">
               
                
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>