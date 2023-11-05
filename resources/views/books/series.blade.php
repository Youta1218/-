<x-app-layout>
    <x-slot name="header">
        <p class=daimei>{{ $series->name }}</p>
    </x-slot>
    <form class='mt-8 mb-2 flex justify-center items-center' action="/series/{{$series->id}}" method="GET">
        <select name='orderNum'>
            <option value=1 @if($orderNum==1 ) selected @endif>作成日時（新しい順）</option>
            <option value=2 @if($orderNum==2 ) selected @endif>作成日時（古い順）</option>
            <option value=3 @if($orderNum==3 ) selected @endif>巻数（１～最新巻）</option>
            <option value=4 @if($orderNum==4 ) selected @endif>巻数（最新巻～１）</option>
            
        </select>
          <input type="submit" class='bg-indigo-700 text-white m-2 py-2 px-4 rounded' value="並び替える">
    </form>    
    <div class='my-8 grid grid-cols-3 content-stretch place-self-stretch'>
        @foreach($books as $book)
            <div class='gap-4 mb-8 m-auto'>
                <div class='text-center'>
                    <h3><表紙></h3>
                    <a href="/books/{{ $book->id }}"><img class='item-center mx-auto w-30 h-48 border-8 border-indigo-600' src="{{ $book->front_cover_image_path }}" alt="画像が読み込めません。"/></a>                    
                </div>
                <a href="/books/{{ $book->id }}"><タイトル>  {{ $book->title }}</a>
                <h3></h3>
                <a href="/books/{{ $book->id }}"><作者>  {{ $book->author }}</a>
            </div>
        @endforeach    
    </div>   
    {{ $books->links() }}
</x-app-layout>