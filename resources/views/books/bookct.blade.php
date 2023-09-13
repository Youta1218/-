<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>本登録</title>
    </head>
    <body>
        <h1>本登録ページ</h1>
        <form action="/books" method="BOOk">
            @csrf
            <div class="book_inf">
                <h2>本情報</h2>
                <h4>題名</h4>                
                <input type="text" name="book[title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                <h4>作者</h4> 
                <textarea name="book[author]" placeholder="作者"></textarea>
                <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                <input type=text name="book[front_cover_image_path]" placeholder="本の表紙">
                <h4>本の場所</h4> 
                <select name="book[bookshelf_id]">
                    <input type=text name="bookshelf[place]" placeholder="本棚">
                    @foreach($bookshelves as $bookshelf)
                        <option value="{{ $bookshelf->id }}">{{ $bookshelf->name }}</option>
                    @endforeach
                    <input type=text name="bookshelf[bookshelf_image_path]" placeholder="本棚の写真">
                </select>
                <h4>カテゴリー</h4> 
                <select name="book[category_id]">
                    <input type=text name="category[name]" placeholder="カテゴリー">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <h4>シリーズ</h4> 
                <select name="book[series_id]">
                    <input type=text name="series[name]" placeholder="シリーズ名">
                    @foreach($series_list as $series)
                        <option value="{{ $series->id }}">{{ $series->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="body">
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>