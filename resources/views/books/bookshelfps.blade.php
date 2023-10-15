    <x-app-layout>
        <x-slot name="header">
            本棚一覧
        </x-slot>
        <div class='ml-8 mr-8 mt-8'>
            <div class='grid grid-cols-3 place-self-stretch'>
                @foreach($bookshelves as $bookshelf)
                    <div class='gap-4 m-8'>
                        <div class='text-center'>
                            <a href="/bookshelves/{{$bookshelf->id}}">{{$bookshelf->name}}</a>
                        </div>
                        <div class=''>
                            <a href="/bookshelves/{{$bookshelf->id}}"><img class ='h-48 mx-auto border-8 border-indigo-600' src="{{ $bookshelf->bookshelf_image_path }}" alt="画像が読み込めません。"/></a>
                        </div>
                    </div>
                @endforeach    
            </div>
        </div>    
</x-app-layout>