<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ブログ作成</title>
    </head>
    <body>
        <h1>ブログ作成ページ</h1>
        <form action="/blogs" method="BLOG">
            @csrf
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="blog[blog_title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('blog.blog_title') }}</p>
            </div>
            <div class="body">
                
                <h4>題名</h4>                
                <input type="text" name="blog[book_title]" placeholder="タイトル"/>
                <p class="book_title__error" style="color:red">{{ $errors->first('blog.book_title') }}</p>
                <h4>作者</h4> 
                <textarea name="blog[author]" placeholder="作者"></textarea>
                <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                
                <input type=text name="book[front_cover_image_path]" placeholder="本の表紙">
                <h4>カテゴリー</h4> 
                <select name="blog[category_id]">
                    <input type=text name="category[name]" placeholder="カテゴリー">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <h4>シリーズ</h4> 
                <select name="blog[series_id]">
                    <input type=text name="series[name]" placeholder="シリーズ名">
                    @foreach($series_list as $series)
                        <option value="{{ $series->id }}">{{ $series->name }}</option>
                    @endforeach
                </select>
                <h4>本文</h4>
                <textarea name="blog[blog_body]" ></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('blog.blog_body') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>