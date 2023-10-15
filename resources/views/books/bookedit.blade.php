<x-app-layout>
    <x-slot name="header">
        本登録情報編集
    </x-slot>
    <form action="/books/update/{{$book->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="book_inf">
            <h4>題名</h4>                
            <input type='text' name='book[title]' value="{{ $book->title }}">
            <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
            <h4>作者</h4> 
            <input type='text' name='book[author]' value="{{ $book->author }}">
            <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
            <h3>表紙</h3>
            <input type='file' name='front_cover_image_path' value="{{ $book->front_cover_image_path }}">
            <div class='text-red-600'>
                ※編集する際には表紙を選択する必要があります。
            </div>   
            <p class="image__error" style="color:red">{{ $errors->first('front_cover_image_path') }}</p>    
            <h4>本棚</h4> 
            <input type=text name="bookshelf[bookshelf_input_name]" value="{{ $book->bookshelf->name }}">
            <select name="bookshelf[bookshelf_select_name]">
                @foreach($bookshelves as $bookshelf)
                    <option value="{{ $bookshelf->name }}">{{ $bookshelf->name }}</option>
                @endforeach
            </select>
            <h3>本棚</h3>
            <input type='file' name='bookshelf_image_path' value="{{ $book->bookshelf->bookshelf_image_path }}">
            <div class='text-red-600'>
                ※すでに追加された本棚を選択した場合は選択する必要はありません。
            </div>    
            <h4>本の場所</h4> 
            <input type='text' name='book[place]' value="{{ $book->place }}">
            <p class="place__error" style="color:red">{{ $errors->first('place.author') }}</p>
            <h4>カテゴリー</h4> 
            <input type='text' name='category_input_name' value="{{ $book->category->name }}">
            <select name="category_select_name">
                @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class='text-red-600'>
                ※すでに追加されているカテゴリー名を書いた場合もカテゴリー名を選択した扱いになります。
            </div>  
            <h4>シリーズ</h4> 
            <input type='text' name='series_input_name' value="{{ $book->series->name }}">
            <select name="series_select_name">
                @foreach($series_list as $series)
                    <option value="{{ $series->name }}">{{ $series->name }}</option>
                @endforeach
            </select>
            <div class='text-red-600'>
                ※すでに追加されているシリーズ名を書いた場合もシリーズ名を選択した扱いになります。
            </div> 
        </div>
        <input class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' type="submit" value="[保存]"/>
        <div class="back"><a class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' href="/books/{{$book->id}}">[戻る]</a></div>
    </form>
</x-app-layout>