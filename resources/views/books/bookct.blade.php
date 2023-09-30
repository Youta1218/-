<x-app-layout>
        <x-slot name="header">
         本情報登録ページ
        </x-slot>
    <body>
     
        <form action="/books" method="POST" enctype="multipart/form-data">
            @csrf
           
         
                <h2>本情報</h2>
                <div class="book_title">
                <h4>題名</h4>                
                <input type="text" name="book[title]" placeholder="タイトル" value="{{ old('book.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                </div>
                <div class="book_author">
                <h4>作者</h4> 
                <input name="book[author]" placeholder="作者" value="{{ old('book.author') }}"/>
                <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                </div>
                <div class="front_cover_image">
                <h4>表紙</h4>
                <input type="file" name="front_cover_image_path">
                </div>
                <div class="bookshelfname">
                <h4>本棚</h4> 
                <input type=text name="bookshelf[bookshelf_input_name]" placeholder="本棚">
                <select name="bookshelf[bookshelf_select_name]">
                    @foreach($bookshelves as $bookshelf)
                        <option value="{{ $bookshelf->name }}">{{ $bookshelf->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="bookplace">    
                <h4>本の場所</h4> 
                <input type=text name="book[place]" placeholder="本の場所">
                
                </div>
                <div class="front_cover_image">
                <h4>本棚の写真</h4>
                <input type="file" name="bookshelf_image_path">
                </div>
                <div class="book_category">
                <h4>カテゴリー</h4> 
                <input type=text name="category_input_name" placeholder="カテゴリー">
                <select name="category_select_name">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="book_series">
                <h4>シリーズ</h4> 
                <input type=text name="series_input_name" placeholder="シリーズ名">
                <select name="series_select_name">
                    @foreach($series_list as $series)
                        <option value="{{ $series->name }}">{{ $series->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="body">
            </div>
            <input type="submit" value="[保存]"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</x-app-layout>
        