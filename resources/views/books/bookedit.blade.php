<x-app-layout>
    <x-slot name="header">
        本登録情報編集
    </x-slot>
    <form action="/books/update/{{$book->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class='mt-8 mb-2'>
            <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch '>
                <div class="p-12 ml-20 bg-white shadow-sm sm:rounded-lg ">
                    <div class='text-xl'>
                        <本情報>
                    </div>
                    <h4>題名</h4>                
                    <input type='text' name='book[title]' value="{{ $book->title }}">
                    <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                    <h4>作者</h4> 
                    <input type='text' name='book[author]' value="{{ $book->author }}">
                    <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                    <h3>表紙</h3>
                    <input type='file' name='front_cover_image_path' value="{{ $book->front_cover_image_path }}">
                    <p class="image__error" style="color:red">{{ $errors->first('front_cover_image_path') }}</p> 
                    <div class='text-red-600'>
                        ※編集する際は表紙を毎回選択する必要があります。
                    </div>
                    <h4>カテゴリー</h4> 
                    <input type='text' name='category_input_name' value="{{ $book->category->name }}">
                    <select name="category_select_name">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <h4>シリーズ</h4> 
                    <input type='text' name='series_input_name' value="{{ $book->series->name }}">
                    <select name="series_select_name">
                        @foreach($series_list as $series)
                            <option value="{{ $series->id }}">{{ $series->name }}</option>
                        @endforeach
                    </select>
                    <div class='text-red-600'>
                        <h4>■カテゴリー・シリーズ・本棚について</h4>
                        <p>※選択欄にデータが無い場合はデータを追加する必要があります。</p>
                        <p>※記入欄に選択欄に追加されているデータを書いた場合は</p>
                        <p>　選択欄のデータを選択した扱いと同じになります。</p>
                    </div> 
                </div>
                <div>
                    <div class="p-12 mr-20 bg-white shadow-sm sm:rounded-lg ">
                        <div class='text-xl'>
                            <本棚情報>
                        </div>
                        <h4>本棚</h4> 
                        <input type=text name="bookshelf[bookshelf_input_name]" value="{{ $book->bookshelf->name }}">
                        <select name="bookshelf[bookshelf_select_name]">
                            @foreach($bookshelves as $bookshelf)
                                <option value="{{ $bookshelf->name }}">{{ $bookshelf->name }}</option>
                            @endforeach
                        </select>
                        <h3>本棚の写真</h3>
                        <input type='file' name='bookshelf_image_path' value="{{ $book->bookshelf->bookshelf_image_path }}">
                        <h4>本の場所</h4> 
                        <input type='text' name='book[place]' value="{{ $book->place }}">
                        <p class="place__error" style="color:red">{{ $errors->first('place.author') }}</p>
                        <div class='text-red-600'>
                            <h4>■本棚の写真について</h4>
                            <p>※最初は必ず本棚の写真を選択する必要があります。</p>
                            ※追加された本棚を選択した場合は選択する必要はありません。
                        </div>   
                    </div>    
                    <div class='my-12 flex justify-center items-center'>
                        <div class='px-12 py-4 ml-40'>
                            <input class='mx-8 bg-indigo-700 text-white my-2 py-1 px-4 rounded' type="submit" value="[保存]"/>
                        </div>
                        <div class='px-12 py-4 mr-40'>
                            <div class="back"><a class='mx-8 bg-indigo-700 text-white my-2 py-1 px-4 rounded' href="/">[home]</a></div>
                        </div>
                    </div>  
                </div>
            </div>    
        </div>
    </form>
</x-app-layout>