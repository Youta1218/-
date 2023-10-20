<x-app-layout>
    <x-slot name="header">
        お気に入り
    </x-slot>
        <div class='my-8 grid grid-cols-3 content-stretch place-self-stretch'>
            @foreach ($books as $book)
                <div class='gap-4 mb-4 m-auto'>
                    <div class='text-center'>
                        <div><表紙></div>
                        <a class='text-center' href="/books/{{ $book->id }}"><img class='items-center mx-auto h-48 w-30 border-8 border-indigo-600' src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>                    
                    </div>
                    <a href="/books/{{ $book->id }}"><タイトル>  {{ $book->title }}</a>
                    <h3></h3>
                    <a href="/books/{{ $book->id }}"><作者>  {{ $book->author }}</a>
                </div>
            @endforeach
        </div>   
        <div class='text-center'>
        {{--{{ $books->links() }}--}}
        </div>    
</x-app-layout>