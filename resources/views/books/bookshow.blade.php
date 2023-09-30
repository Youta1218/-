<x-app-layout>
        <x-slot name="header">
            <p class=daimei>{{ $book->title }}</p>
        </x-slot>
    <body>
         <div class='content'>
                <div class='book_content'>
                    <h3>題名</h3>
                    <h2 class='bg-red-300'>{{ $book->title }}</h2>
                    <h3>作者</h3>
                    <p class='author'>{{ $book->author }}</p>
                    <div class='front_cover_image'>
                    <h3>表紙</h3>
                    <img class='h-48 border-8 border-indigo-600' src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/>
                    </div>
                    <h3>本棚</h3>
                    <p class='name'>{{ $book->bookshelf->name }}</p>
                    <h3>本の場所</h3>
                    <p class='place'>{{ $book->place }}</p>
                    <h3>カテゴリー</h3>
                    <p class='category'>{{ $book->category->name }}</p>
                    <h3>シリーズ名</h3>
                    <p class='series'>{{ $book->series->name }}</p>
                    <div class='bookshelf'>
                    <h3>本棚</h3>
                    <img src="{{ $book->bookshelf->bookshelf_image_path }}" alt="画像が読み込めません。"/>
                    </div>
                </div>
                <form action="/books/{{ $book->id }}" id="form_{{ $book->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="bookdeletePost({{$book->id}})">[削除]</button>
                </form>
        </div>
        <div class="edit"><a href="/books/{{ $book->id }}/bookedit">[本情報編集]</a></div>
       <div class="footer">
            <a href="/">[戻る]</a>
        </div>
    <script>
    function bookdeletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>    
    </body>
</x-app-layout>