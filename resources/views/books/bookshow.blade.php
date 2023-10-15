<x-app-layout>
    <x-slot name="header">
        <p class=daimei>{{ $book->title }}</p>
    </x-slot>
    <div class='my-8 book_content'>
        <div class='float-left ml-40'>
            <!--<h3>題名</h3>-->
            <h2 class=''><題名>{{ $book->title }}</h2>
            <!--<h3>作者</h3>-->
            <p class='author'><作者>{{ $book->author }}</p>
            <div class='front_cover_image'>
                <表紙>
                <img class='h-48 border-8 border-indigo-600' src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/>
            </div>
            <!--<h3>カテゴリー</h3>-->
            <p class='category'><カテゴリー名>{{ $book->category->name }}</p>
            <!--<h3>シリーズ名</h3>-->
            <p class='series'><シリーズ名>{{ $book->series->name }}</p>
            <div class='mt-4'>
                <a class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' href="/books/{{ $book->id }}/bookedit">[本情報編集]</a>
                <form action="/books/{{ $book->id }}" id="form_{{ $book->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' type="button" onclick="bookdeletePost({{$book->id}})">[削除]</button>
                </form>
                <a class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' href="/books/bookps">[戻る]</a>
            </div>    
        </div>
        
        <div class='float-right mr-40'>
            <!--<h3>本棚</h3>-->
            <p class='name'><本棚>{{ $book->bookshelf->name }}</p>
            <!--<h3>本の場所</h3>-->
            <p class='place'><本の場所>{{ $book->place }}</p>
            <div class='bookshelf'>
                <本棚の写真>
                <img class='h-48 border-8 border-indigo-600' src="{{ $book->bookshelf->bookshelf_image_path }}" alt="画像が読み込めません。"/>
            </div>
        </div>
    </div>    
    
    <script>
        function bookdeletePost(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>    
</x-app-layout>