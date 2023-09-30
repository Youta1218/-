<x-app-layout>
        <x-slot name="header">
         BLOG EDIT
        </x-slot>
    <body>
        <h1>Blog Name</h1>
        <form action="/blogs/1/{{$blog->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class='blog_inf'>
                <h3>ブログタイトル</h3>
                <input type='text' name='blog[blog_title]' value="{{ $blog->blog_title }}">
                
                <h3>題名</h3>
                <input type='text' name='blog[book_title]' value="{{ $blog->book_title }}">
                <h3>作者</h3>
                <input type='text' name='blog[author]' value="{{ $blog->author }}">
                <h3>表紙</h3>
                <input type='file' name='front_cover_image_path' value="{{ $blog->front_cover_image_path }}">
                <h3>カテゴリー</h3>
                <input type='text' name='category_input_name' value="{{ $blog->category->name }}">
                <select name="category_select_name">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <h3>シリーズ</h3>
                <input type='text' name='series_input_name' value="{{ $blog->series->name }}">
                <select name="series_select_name">
                    @foreach($series_list as $series)
                        <option value="{{ $series->name }}">{{ $series->name }}</option>
                    @endforeach
                </select>
                <h3>review</h3>
                <input type='text' name='blog[blog_body]' value="{{ $blog->blog_body }}">
                </div>
    
                <input type="submit" value="[保存]"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</x-app-layout>
        