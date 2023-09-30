<x-app-layout>
        <x-slot name="header">
            ALL
        </x-slot>
    <body>
         <div class='posts'>
            @foreach ($books as $book)
                <div class='post'>
                    <h3>表紙</h3>
                    <a href="/books/{{ $book->id }}"><img src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>                    
                    <h3>タイトル</h3>
                    <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
                    <h3>作者</h3>
                    <a href="/books/{{ $book->id }}">{{ $book->author }}</a>
                
                </div>
            
            @endforeach
        </div>
        <div class='paginate'>
            {{ $books->links() }}
        </div>
        
    </body>
</x-app-layout>