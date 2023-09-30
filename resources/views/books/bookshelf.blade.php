<x-app-layout>
        <x-slot name="header">
         本棚ごとのタイトル
        </x-slot>
    <body>
        <h1>本棚ごとのデータ名</h1>
         <div class='posts'>
                <div class='shelf'>
                    <h2>本棚</h2>
                    @foreach($books as $book)
                        <div>
                            <a href="/bookshelves/{{ $book->bookshelf->id }}">{{ $book->title }}</a>
                        </div>
                        <div>
                            <a href="/bookshelves/{{ $book->bookshelf->id }}"><img src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>
                        </div>
                    @endforeach   
                </div>
        </div>
    </body>
</x-app-layout>