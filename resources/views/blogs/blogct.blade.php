<x-app-layout>
        <x-slot name="header">
         ブログ投稿ページ
        </x-slot>
    <body>
        <form action="/blogs" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="blog_title">
                <h2>タイトル</h2>
                <input type="text" name="blog[blog_title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('blog.blog_title') }}</p>
            </div>
            <div class="body">
                <div class="book_title">
                <h4>題名</h4>                
                <input type="text" name="blog[book_title]" placeholder="タイトル"/>
                <p class="book_title__error" style="color:red">{{ $errors->first('blog.book_title') }}</p>
                </div>
                <div class="author">
                <h4>作者</h4> 
                <textarea name="blog[author]" placeholder="作者"></textarea>
                <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                </div>
                <div class="front_cover_image">
                <h4>表紙</h4>
                <input type="file" name="front_cover_image_path">
                </div>
                <div class="blog_category">
                <h4>カテゴリー</h4> 
                <input type=text name="category_input_name" placeholder="カテゴリー">
                <select name="category_select_name">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="blog_series">
                <h4>シリーズ</h4> 
                <input type=text name="series_input_name" placeholder="シリーズ名">
                <select name="series_select_name">
                    @foreach($series_list as $series)
                        <option value="{{ $series->name }}">{{ $series->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="blog_body">
                <h4>本文</h4>
                <textarea name="blog[blog_body]" ></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('blog.blog_body') }}</p>
                </div>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</x-app-layout>
        