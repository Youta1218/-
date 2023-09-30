    <x-app-layout>
        <x-slot name="header">
            HOME
        </x-slot>
    <body>
         <div class='posts'>
             <a href='/books/bookps'>ALL</a>
                <div class='shelf'>
                    <h2>シリーズ</h2>
                    @foreach($series_list as $series)
                        <div>
                            <a href="/books/{{$series->id}}">{{$series->name}}</a>
                        </div>
                    @endforeach    
                </div>
                <div class='category'>
                    <h2>カテゴリー</h2>                    
                    @foreach($categories as $category)
                        <div>
                            <a href="/categories/{{$category->id}}">{{$category->name}}</a>
                        </div>
                    @endforeach    
                </div>
                <div class='bookshelf'>
                    <h2>本棚</h2>                    
                    @foreach($bookshelves as $bookshelf)
                        <div>
                            <a href="/bookshelves/{{$bookshelf->id}}">{{$bookshelf->name}}</a>
                        </div>
                    @endforeach    
                </div>
        </div>
    </body>
</x-app-layout>