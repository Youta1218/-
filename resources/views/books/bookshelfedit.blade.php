<x-app-layout>
    <x-slot name="header">
        本棚情報編集
    </x-slot>
    <form action="/bookshelf/update/{{$bookshelf->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class='mt-8 mb-2 flex justify-center items-center'>
            <div class="p-12 m-auto mx-80 bg-white shadow-sm sm:rounded-lg  ">
                <h4>本棚</h4> 
                <input type=text name="bookshelf[name]" value="{{ $bookshelf->name }}">
                <h3>本棚</h3>
                <input type='file' name='bookshelf_image_path' value="{{ $bookshelf->bookshelf_image_path }}">
            </div>
        </div>
        <div class='block mt-8 flex justify-center items-center'>
            <input class='block bg-indigo-700 text-white my-2 py-1 px-4 rounded' type="submit" value="[保存]"/>
            <div class="back"><a class='bg-indigo-700 text-white mx-8 my-2 py-1 px-4 rounded' href="/bookshelves">[戻る]</a></div>
        </div>  
    </form>
</x-app-layout>