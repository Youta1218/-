<x-app-layout>
    <x-slot name="header">
        BLOG
    </x-slot>
    <div class="float-left bg-green-100 min-h-screen px-8 pt-16 pb-full">
        <form action="{{ route('BLOG') }}" method="GET">
            @csrf
            <div class="form-group">
                <div>
                    <label for="">キーワード
                    <div>
                        <input type="text" name="keyword" value="{{ $keyword }}">
                    </div>
                    </label>
                </div>
                <input type="submit" class='bg-indigo-700 text-white my-2 py-1 px-4 rounded' value="検索">
            </div>
        </form>
    </div>
    <div class=''>
        <div class='grid grid-cols-3 gap-4 content-stretch place-self-stretch '>
            @foreach ($blogs as $blog)
                <div class="py-12 px-6 mt-4 mx-10 bg-white shadow-sm sm:rounded-lg flex flex-col justify-center items-center">
                    
                    <div class='mb-4 flex w-full'>
                        <h2 class='blog_title'><a href="/blogs/{{ $blog->id }}">{{ $blog->blog_title }}</a></h2>
                    </div>
                    <div class='text-center'>
                        <表紙>
                        <img class=' h-48 border-8 border-indigo-600' src="{{ $blog->front_cover_image_path }}" alt="画像が読み込めません。"/>
                    </div>
                    <div class='w-full'>
                    <h4 class='book_title'><題名>{{ $blog->book_title }}</h4>
                    <p class='author'><作者>{{ $blog->author }}</p>
                    
                    @auth
                    <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                    @if (!$blog->isLikedBy(Auth::user()))
                        <span class="likes">
                            いいね
                            <i class="fas fa-heart like-toggle" data-blog-id="{{ $blog->id }}"></i>
                        <span class="like-counter">{{$blog->blog_likes_count}}</span>
                        </span><!-- /.likes -->
                    @else
                        <span class="likes">
                            いいね
                            <i class="fas fa-heart heart like-toggle liked" data-blog-id="{{ $blog->id }}"></i>
                        <span class="like-counter">{{$blog->blog_likes_count}}</span>
                        </span><!-- /.likes -->
                    @endif
                    @endauth
                    </div>
                </div>    
            @endforeach
        </div>    
    </div>
    {{ $blogs->links() }}
    
</x-app-layout>