<x-app-layout>
    <x-slot name="header">
        <p class=daimei>{{ $blog->blog_title }}</p>
    </x-slot>
    <div class='my-8'>
        <div class='grid grid-cols-2 gap-4 content-stretch place-self-stretch place-items-center'>
            <div class='my-auto'>
                <div class="p-12 ml-40 bg-white shadow-sm sm:rounded-lg ">
                    <h2 class='book_title'><タイトル>{{ $blog->book_title }}</h2>
                    <p class='author'><作者>{{ $blog->author }}</p>
                    <div class='my-4'>
                        <h3><表紙></h3>
                        <img class='h-48 border-8 border-indigo-600' src="{{ $blog->front_cover_image_path }}" alt="画像が読み込めません。"/>
                    </div>
                </div>
                
            </div>
            <div class='my-auto'>
                <div class=''>
                    <div class="p-12 mr-40 bg-white shadow-sm sm:rounded-lg">
                        <p class='category'><カテゴリー>{{ $blog->category->name }}</p>
                        <p class='series'><シリーズ>{{ $blog->series->name }}</p>
                    </div>
                </div>
                <div class='mt-8'>
                    <div class="p-12 mr-40 bg-white shadow-sm sm:rounded-lg">
                        <h3><コメント></h3>
                        <p class='my-4'>{{ $blog->blog_title }}</p>
                        <p class='mt-8'>{{ $blog->blog_body }}</p>
                    </div>    
                </div>
                
            </div>
        </div>
        <div class='flex justify-center'>
            <div class='p-12 ml-40'>
                @if(auth()->id() == $blog->user_id)
                    <div class="edit"><a class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' href="/blogs/{{ $blog->id }}/blogedit">[ブログ投稿情報編集]</a></div>
                    <form action="/blogs/{{ $blog->id }}" id="form_{{ $blog->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' type="button" onclick="blogdeletePost({{$blog->id}})">[削除]</button>
                    </form>
                @endif
            </div>
            <div class='p-12 mr-40'>
                <button class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' onclick="history.back();">[戻る]</button>
            </div>
        </div>
    </div>
    <script>
        function blogdeletePost(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
            }
        }
    </script>    
</x-app-layout>