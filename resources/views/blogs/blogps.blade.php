<x-app-layout>
        <x-slot name="header">
            BLOG
        </x-slot>
    <body>

         <div class='posts'>
            @foreach ($blogs as $blog)
                <div class='post'>
                    <h2 class='blog_title'><a href="/blogs/{{ $blog->id }}">{{ $blog->blog_title }}</a></h2>

                    <h3>題名</h3> 
                    <h4 class='book_title'>{{ $blog->book_title }}</h4>

                    <h3>作者</h3> 
                    <p class='author'>{{ $blog->author }}</p>

                    <h3>表紙</h3>
                    <p class='cover'><img src="{{ $blog->front_cover_image_path }}" alt="画像が読み込めません。"/></p>
                   
                    <h3>コメント</h3>
                    <p class='blog_body'>{{ $blog->blog_body }}</p>
                   
                    <h3>カテゴリー</h3>
                    <p class='category'>{{ $blog->category->name }}</p>
                    <h3>シリーズ名</h3>
                    <p class='series'>{{ $blog->series->name }}</p>
                    <form action="/blogs/{{ $blog->id }}" id="form_{{ $blog->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="blogdeletePost({{$blog->id}})">削除</button>
                </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $blogs->links() }}
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