<x-app-layout>
    <x-slot name="header">
        本棚情報編集
    </x-slot>
    <form action="/bookshelf/update/{{$bookshelf->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="book_inf">

            <h4>本棚</h4> 
            <input type=text name="bookshelf[name]" value="{{ $bookshelf->name }}">
            <h3>本棚</h3>
            <input type='file' name='bookshelf_image_path' value="{{ $bookshelf->bookshelf_image_path }}">
        <input class='block bg-indigo-700 text-white my-2 py-1 px-4 rounded' type="submit" value="[保存]"/>
        <div class="back"><a class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' href="/bookshelves">[戻る]</a></div>
    </form>
</x-app-layout>