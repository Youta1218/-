<x-app-layout>
    <x-slot name="header">
        ALL
    </x-slot>
    <form class='mt-8 mb-2 flex justify-center items-center' action="{{ route('ALL') }}" method="GET">
        
        <select name='orderNum'>
            <option value=1>作成日時（新しい順）</option>
            <option value=2>作成日時（古い順）</option>
            <option value=3>タイトル（あ→わ）</option>
            <option value=4>タイトル（わ→あ）</option>
        </select>
          <input type="submit" class='bg-indigo-700 text-white m-2 py-2 px-4 rounded' value="並び替える">
    </form>    
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
    {{ $books->links() }}
    </div>    
</x-app-layout>