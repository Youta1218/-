<x-app-layout>
        <x-slot name="header">
            <p class=daimei>{{ $blog->blog_title }}</p>
        </x-slot>
    <body>
        </h1>
         <div class='content'>
                <div class='blog_content'>
                    <h3>題名</h3>
                    <h2 class='book_title'>{{ $blog->book_title }}</h2>
                    <h3>著者</h3>
                    <p class='author'>{{ $blog->author }}</p>
                    <div class='front_cover_image'>
                    <h3>表紙</h3>
                    <img src="{{ $blog->front_cover_image_path }}" alt="画像が読み込めません。"/>
                    </div>
                    <h3>カテゴリー</h3>
                    <p class='category'>{{ $blog->category->name }}</p>
                    <h3>シリーズ名</h3>
                    <p class='series'>{{ $blog->series->name }}</p>
                    <h3>コメント</h3>
                    <p class='blog_body'>{{ $blog->blog_body }}</p>
                </div>
                <form action="/blogs/{{ $blog->id }}" id="form_{{ $blog->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="blogdeletePost({{$blog->id}})">[削除]</button>
                </form>
        </div>
        <div class="edit"><a href="/blogs/{{ $blog->id }}/blogedit">[ブログ投稿情報編集]</a></div>
       <div class="footer">
            <a href="/">[戻る]</a>
        </div>
        <script>
    function blogdeletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>    
    </body>
</x-app-layout>