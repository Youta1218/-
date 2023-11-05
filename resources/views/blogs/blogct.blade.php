<x-app-layout>
    <x-slot name="header">
     ブログ投稿ページ
    </x-slot>
    <form action="/blogs" method="POST" enctype="multipart/form-data">
        @csrf
        <div class='mt-8 mb-2'>
            <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch '>
                <div class="p-12 ml-20 bg-white shadow-sm sm:rounded-lg ">
                    <div class="body">
                        <div class="book_title">
                            <div class='text-xl'>
                                <本情報>
                            </div>
                            <h4>題名</h4>                
                            <input type="text" name="blog[book_title]" placeholder="タイトル"/>
                            <p class="book_title__error" style="color:red">{{ $errors->first('blog.book_title') }}</p>
                        </div>
                        <div class="author">
                            <h4>作者</h4> 
                            <input type="text" name="blog[author]" placeholder="作者"></input>
                            <p class="author__error" style="color:red">{{ $errors->first('blog.author') }}</p>
                        </div>
                        <div class="front_cover_image">
                            <h4>表紙</h4>
                            <input type="file" name="front_cover_image_path">
                            <p class="image__error" style="color:red">{{ $errors->first('front_cover_image_path') }}</p>
                        </div>
                        <div class="blog_category">
                            <h4>カテゴリー</h4> 
                            <input type=text name="category_input_name" placeholder="カテゴリー">
                            <select name="category_select_name">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                              
                        </div>
                        <div class="blog_series">
                            <h4>シリーズ</h4> 
                            <input type=text name="series_input_name" placeholder="シリーズ名">
                            <select name="series_select_name">
                                @foreach($series_list as $series)
                                    <option value="{{ $series->id }}">{{ $series->name }}</option>
                                @endforeach
                            </select>
                            <div class='text-red-600'>
                                <h4>■カテゴリーとシリーズについて</h4>
                                <p>※選択欄にデータが無い場合はデータを追加する必要があります。</p>
                                <p>※記入欄に選択欄に追加されているデータを書いた場合は</p>
                                <p>　選択欄のデータを選択した扱いと同じになります。</p>
                            </div> 
                        </div>
                    </div>
                </div>
                <div>
                    <div class="p-12 mr-20 bg-white shadow-sm sm:rounded-lg ">
                        <div class='text-xl'>
                            <ブログ情報>
                        </div>
                        <div class="blog_title">
                            <h2>タイトル</h2>
                            <input type="text" name="blog[blog_title]" placeholder="タイトル"/>
                            <p class="title__error" style="color:red">{{ $errors->first('blog.blog_title') }}</p>
                        </div>
                        <div class="blog_body">
                            <h4>本文</h4>
                            <textarea name="blog[blog_body]" ></textarea>
                            <p class="body__error" style="color:red">{{ $errors->first('blog.blog_body') }}</p>
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
        