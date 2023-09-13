<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>投稿編集ページ</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/blogs" method="BLOG">
            @csrf
            @method('PUT')
            <div class='bloginf'>
                <h3>題名</h3>
                <input type='text' name='blog[book_title]' value="{{ $blog->book_title }}">
                <h3>作者</h3>
                <input type='text' name='blog[author]' value="{{ $blog->author }}">
                <h3>表紙</h3>
                <input type='text' name='blog[front_cover_image_path]' value="{{ $blog->front_cover_image_path }}">
                <h3>カテゴリー</h3>
                <input type='text' name='category[name]' value="{{ $blog->category->name }}">
                <h3>シリーズ</h3>
                <input type='text' name='series[name]' value="{{ $blog->series->name }}">
            </div>
            <div class='blog_title'>
                <h3>ブログタイトル</h3>
                <input type='text' name='blog[blog_title]' value="{{ $blog->blog_title }}">
            </div>
            <div class='blog_body'>
                <h3>review</h3>
                <input type='text' name='blog[blog_body]' value="{{ $blog->blog_body }}">
            </div> 
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>