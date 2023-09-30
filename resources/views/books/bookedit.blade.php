<x-app-layout>
        <x-slot name="header">
         BOOK EDIT
        </x-slot>
    <body>
        <h1>本登録情報編集</h1>
        <form action="/books/1/{{$book->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="book_inf">
                <h2>本情報</h2>
                <h4>題名</h4>                
                <input type='text' name='book[title]' value="{{ $book->title }}">
                <h4>作者</h4> 
                <input type='text' name='book[author]' value="{{ $book->author }}">
                <h3>表紙</h3>
                <input type='file' name='front_cover_image_path' value="{{ $book->front_cover_image_path }}">
                <h4>本棚</h4> 
                <input type=text name="bookshelf[bookshelf_input_name]" value="{{ $book->bookshelf->name }}">
                <select name="bookshelf[bookshelf_select_name]">
                    @foreach($bookshelves as $bookshelf)
                        <option value="{{ $bookshelf->name }}">{{ $bookshelf->name }}</option>
                    @endforeach
                </select>
                </div>
                <h4>本の場所</h4> 
                <input type='text' name='book[place]' value="{{ $book->place }}">
                <h4>カテゴリー</h4> 
                <input type='text' name='category_input_name' value="{{ $book->category->name }}">
                <select name="category_select_name">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <h4>シリーズ</h4> 
                <input type='text' name='series_input_name' value="{{ $book->series->name }}">
                <select name="series_select_name">
                    @foreach($series_list as $series)
                        <option value="{{ $series->name }}">{{ $series->name }}</option>
                    @endforeach
                </select>
                <h3>本棚</h3>
                <input type='file' name='bookshelf_image_path' value="{{ $book->bookshelf->bookshelf_image_path }}">
            </div>
            [<input type="submit" value="保存"/>]
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</x-app-layout>