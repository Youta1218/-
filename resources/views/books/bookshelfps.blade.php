    <x-app-layout>
        <x-slot name="header">
            本棚一覧
        </x-slot>
        <div class='ml-8 mr-8 mt-8'>
            <div class='grid grid-cols-3 place-self-stretch'>
                @foreach($bookshelves as $bookshelf)
                    <div class='gap-4 m-8 bg-white shadow-sm sm:rounded-lg'>
                        <div class='text-center my-2'>
                            <a href="/bookshelves/{{$bookshelf->id}}"><本棚> {{$bookshelf->name}} {{$bookshelf->getBookCount()}}件</a>
                        </div>
                        <div class=''>
                            <a href="/bookshelves/{{$bookshelf->id}}"><img class ='h-48 mx-auto border-8 border-indigo-600' src="{{ $bookshelf->bookshelf_image_path }}" alt="画像が読み込めません。"/></a>
                        </div>
                        
                        <a class='flex justify-center bg-indigo-700 text-white my-2 w-5/12 mx-auto py-1 px-4 rounded' href="/bookshelf/{{ $bookshelf->id }}/bookshelfedit">[本棚情報編集]</a>
                    </div>
                @endforeach    
            </div>
        </div>    
        {{ $bookshelves->links() }}
</x-app-layout>