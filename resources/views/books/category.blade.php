<x-app-layout>
    <x-slot name="header">
        <p class=daimei>{{ $category->name }}</p>
    </x-slot>
    <div class='my-8 grid grid-cols-3 content-stretch place-self-stretch'>
        @foreach($books as $book)
            <div class='gap-4 mb-8 m-auto'>
                <div class='text-center'>
                    <h3><表紙></h3>
                    <a href="/books/{{ $book->id }}"><img class='item-center mx-auto h-48 w-30 border-8 border-indigo-600' src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>                    
                </div>
                <a href="/books/{{ $book->id }}"><タイトル>  {{ $book->title }}</a>
                <h3></h3>
                <a href="/books/{{ $book->id }}"><作者>  {{ $book->author }}</a>
            </div>
        @endforeach 
    </div>
    {{ $books->links() }}
</x-app-layout>