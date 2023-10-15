    <x-app-layout>
        <x-slot name="header">
            HOME
        </x-slot>
    <!--//* 検索機能ここから *//-->
    
    <div class="float-left bg-green-100 min-h-screen px-16 pt-16 pb-full">
        <form action="{{ route('HOME') }}" method="GET">
            @csrf
            <div class="form-group">
                <div>
                    <label for="">キーワード
                    <div>
                        <input type="text" name="keyword" value="{{ $keyword }}">
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">シリーズ
                    <div>
                        <select name="series" data-toggle="select">
                            <option value="">全て</option>
                            @foreach ($series_list as $series_item)
                                <option value="{{ $series_item->name }}" @if($series== $series_item->name ) selected @endif >{{ $series_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">カテゴリー
                    <div>
                        <select name="category" data-toggle="select">
                            <option value="">全て</option>
                            @foreach ($categories_list as $categories_item)
                                <option value="{{ $categories_item->name }}" @if($category==$categories_item->name ) selected @endif>{{ $categories_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>

                <div>
                    <button class='bg-indigo-700 text-white my-2 py-1 px-4 rounded'>
                    <input type="submit" class="btn" value="検索">
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!--//* 検索機能ここまで *//-->

    <table class="mt-8 mx-auto p-12 bg-white shadow-sm sm:rounded-lg">
        <tr>
            <th>本タイトル</th>
            <th>シリーズ</th>
            <th>カテゴリー</th>
        </tr>
        <div class='py-2'>
            @foreach ($books as $book)
    
                <tr>
                    <div class='flex space-x-6'>
                    <td><a href="/books/{{ $book->id }}">
                        <div class='pb-2 mx-12 text-black underline underline-offset-4'>
                        {{ $book->title }}</a>
                        </div>
                    </td>
                    <td >
                        <div class='pb-2 mx-12'>
                            {{ $book->series->name }}
                        </div>
                    </td>    
                    <td>
                        <div class='pb-2 mx-12'>
                            {{ $book->category->name }}
                        </div>
                    </td>
                    <!--//mediaテーブルとcategoriesテーブルを結合しているので、この記述でアクセスできる-->
                    </div>
                </tr>
            
            @endforeach
        </div>
    </table>
</x-app-layout>



