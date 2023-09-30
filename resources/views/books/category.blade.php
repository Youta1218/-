<x-app-layout>
        <x-slot name="header">
         カテゴリーごとのタイトル
        </x-slot>
    <body>
        <h1>My Library</h1>
         <div class='posts'>
                <div class='cate'>
                    <h2>カテゴリーごとのデータ名</h2>
                    @foreach($books as $book)
                        <div>
                            <a href="/categories/{{ $book->category->id }}">{{ $book->title }}</a>
                        </div>
                        <div>
                            <a href="/categories/{{ $book->category->id }}"><img src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>
                        </div>
                    @endforeach    
                </div>
        </div>
    </body>
</x-app-layout>