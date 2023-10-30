<x-app-layout>
    <x-slot name="header">
     ブログ情報編集ページ   
    </x-slot>
    <form action="/blogs/update/{{$blog->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class='mt-8 mb-2'>
            <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch '>
                <div class="p-12 ml-20 bg-white shadow-sm sm:rounded-lg ">
                    <div class='text-xl'>
                        <本情報>
                    </div>
                    <h3>題名</h3>
                    <input type='text' name='blog[book_title]' value="{{ $blog->book_title }}">
                    <p class="book_title__error" style="color:red">{{ $errors->first('blog.book_title') }}</p>
                    <h3>作者</h3>
                    <input type='text' name='blog[author]' value="{{ $blog->author }}">
                    <p class="author__error" style="color:red">{{ $errors->first('book.author') }}</p>
                    <h3>表紙</h3>
                    <input type='file' name='front_cover_image_path' value="{{ $blog->front_cover_image_path }}">
                    <p class="image__error" style="color:red">{{ $errors->first('front_cover_image_path') }}</p>
                    <div class='text-red-600'>
                        ※編集する際には表紙を選択する必要があります。
                    </div>    
                    <h3>カテゴリー</h3>
                    <input type='text' name='category_input_name' value="{{ $blog->category->name }}">
                    <select name="category_select_name">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class='text-red-600'>
                        ※すでに追加されているカテゴリー名を書いた場合もカテゴリー名を選択した扱いになります。
                    </div>   
                    <h3>シリーズ</h3>
                    <input type='text' name='series_input_name' value="{{ $blog->series->name }}">
                    <select name="series_select_name">
                        @foreach($series_list as $series)
                            <option value="{{ $series->id }}">{{ $series->name }}</option>
                        @endforeach
                    </select>
                    <div class='text-red-600'>
                        ※すでに追加されているシリーズ名を書いた場合もシリーズ名を選択した扱いになります。
                    </div> 
                </div>
                <div>
                    <div class="p-12 mr-20 bg-white shadow-sm sm:rounded-lg ">
                        <div class='text-xl'>
                            <ブログ情報>
                        </div>
                        <h3>タイトル</h3>
                        <input type='text' name='blog[blog_title]' value="{{ $blog->blog_title }}">
                        <p class="title__error" style="color:red">{{ $errors->first('blog.blog_title') }}</p>
                        <h3>本文</h3>
                        <input type='text' name='blog[blog_body]' value="{{ $blog->blog_body }}">
                        <p class="body__error" style="color:red">{{ $errors->first('blog.blog_body') }}</p>
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
        