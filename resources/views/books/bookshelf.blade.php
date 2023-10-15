<x-app-layout>
    <x-slot name="header">
        <p class=daimei>{{ $bookshelf->name }}</p>
    </x-slot>
    <div class='ml-8 mr-8 mt-8'>
        <div class='grid grid-cols-3'>
            @foreach($books as $book)
            <div class='gap-4 m-8'>
                <div>
                    <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
                </div>
                <div>
                    <a href="/books/{{ $book->id }}"><img class ='h-48 border-8 border-indigo-600' src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>
                </div>
            </div>    
            @endforeach   
        </div>
    </div>
</x-app-layout>