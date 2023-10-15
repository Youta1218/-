<x-app-layout>
    <x-slot name="header">
        シリーズ一覧
    </x-slot>
        <div class='my-8'>
           <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch place-items-center'>
                @foreach($series_list as $series)
                    <div class="py-8 px-20 m-auto bg-white shadow-sm sm:rounded-lg text-xl">
                        <a href="/series/{{$series->id}}">・{{$series->name}}</a>
                    </div>
                @endforeach    
            </div>
        </div>  
    
</x-app-layout>