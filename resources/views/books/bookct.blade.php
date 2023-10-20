<x-app-layout>
        <x-slot name="header">
         本情報登録
        </x-slot>
    <form action="/books" method="POST" enctype="multipart/form-data">
        @csrf
        <div class='mt-8 mb-2'>
            <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch '>
                <div class="p-12 ml-20 bg-white shadow-sm sm:rounded-lg ">
                    <div class='text-xl'>
                        <本情報>
                    </div>
                    <h4>題名</h4>                
                    <input type="text" name="book[title]" placeholder="タイトル" value="{{ old('book.title') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('book.title') }}</p>
                    
                    <div class="book_author">
                        <h4>作者</h4> 
                        <input name="book[author]" placeholder="作者" value="{{ old('book.author') }}"/>
                        <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                    </div>
                    <div class="front_cover_image">
                        <h4>表紙</h4>
                        <input type="file" name="front_cover_image_path">
                        <p class="image__error" style="color:red">{{ $errors->first('front_cover_image_path') }}</p>
                    </div>
                    <h4>カテゴリー</h4> 
                    <input type=text name="category_input_name" placeholder="カテゴリー">
                    <select name="category_select_name">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class='text-red-600'>
                        <p>※最初は必ずカテゴリー名を選択する必要があります。</p>
                        <p>※追加されているカテゴリー名を書いた場合も</p>
                        <p>　カテゴリー名を選択した扱いになります。</p>
                    </div>    
                    <h4>シリーズ</h4> 
                    <input type=text name="series_input_name" placeholder="シリーズ名">
                    <select name="series_select_name">
                        @foreach($series_list as $series)
                            <option value="{{ $series->id }}">{{ $series->name }}</option>
                        @endforeach
                    </select>
                    <div class='text-red-600'>
                        <p>※最初は必ずシリーズ名を選択する必要があります。</p>
                        <p>※追加されているシリーズ名を書いた場合も</p>
                        <p>　シリーズ名を選択した扱いになります。</p>
                    </div> 
                </div>
                <div>
                    <div class="p-12 mr-20 bg-white shadow-sm sm:rounded-lg ">
                        <div class='text-xl'>
                            <本棚情報>
                        </div>
                        <h4>本棚</h4> 
                        <input type=text name="bookshelf[bookshelf_input_name]" placeholder="本棚">
                        <select name="bookshelf[bookshelf_select_name]">
                            @foreach($bookshelves as $bookshelf)
                                <option value="{{ $bookshelf->id }}">{{ $bookshelf->name }}</option>
                            @endforeach
                        </select>
                        <div class="front_cover_image">
                            <h4>本棚の写真</h4>
                            <input type="file" name="bookshelf_image_path">
                            <div class='text-red-600'>
                                <p>※最初は必ず本棚の写真を選択する必要があります。</p>
                                ※追加された本棚を選択した場合は選択する必要はありません。
                            </div>    
                        </div>
                        <div class="bookplace">    
                            <h4>本の場所</h4> 
                            <input type=text name="book[place]" placeholder="本の場所">
                            <p class="place__error" style="color:red">{{ $errors->first('book.place') }}</p>
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
        