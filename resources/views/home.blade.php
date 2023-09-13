<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ホームページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>My Library</h1>
        <a href='/blogs/blogct'>blog_create</a>
        <a href='/books/bookct'>book_create</a>
        <a href='/blogs/blogps'>blog_page</a>
        <a href='/blogs/{blog}/blogedit'>blog_edit</a>
         <div class='posts'>
             <a href='/books/bookps'>全て</a>
                <div class='shelf'>
                    <h2>本棚</h2>
                    @foreach($bookshelves as $bookshelf)
                        <div>
                            <a href="/books/{{$bookshelf->id}}">{{$bookshelf->name}}</a>
                        </div>
                    @endforeach    
                </div>
                <div class='category'>
                    <h2>カテゴリー</h2>                    
                    @foreach($categories as $category)
                        <div>
                            <a href="/books/{{$category->id}}">{{$category->name}}</a>
                        </div>
                    @endforeach    
                </div>
                
        </div>
    </body>
</html>