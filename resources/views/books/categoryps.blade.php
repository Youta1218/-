<x-app-layout>
    <x-slot name="header">
        カテゴリー一覧
    </x-slot>
    <div class='my-8'>
       <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch place-items-center'> 
            @foreach($categories as $category)
                <div class="py-8 px-20 m-auto bg-white shadow-sm sm:rounded-lg text-xl">
                    <a href="/categories/{{$category->id}}">・{{$category->name}} {{$category->getBookCount()}}件</a>
                </div>
            @endforeach  
        </div>
    </div>
   {{ $categories->links() }}
</x-app-layout>