<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //\BookpsRequest;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;
use App\Models\User;
use App\Http\Requests\BookpsRequest;
use Cloudinary;
use Illuminate\Support\Facades\DB;
use App\Models\BookLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BookController extends Controller
{
    public function home (Request $request)
    {
        $user=Auth::user();
         //検索フォームに入力された値を取得
        $series = $request->input('series');
        $category = $request->input('category');
        $keyword = $request->input('keyword');
        $query = Book::query();
        if(!empty($series)) {
            $query->whereHas('series', function ($q) use ($series) {
                $q->where('name', 'LIKE', $series);
            });
            // $query->where('series.name', 'LIKE', $series);
        }

        if(!empty($category)) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', 'LIKE', $category);
            });
            // $query->where('categories.name', 'LIKE', $category);
        }

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        $books = $query->where('user_id', $user->id)->get();
        //dd($books);
        $series_list = $user->series;
        //dd($series_list);
        $categories_list = $user->categories;

        return view('home', compact('books', 'keyword', 'series', 'category', 'series_list', 'categories_list'));
       
    }
    public function booklike(Book $book)//インポートしたBookをインスタンス化して$bookとして使用。
    {
        $user_id=Auth::user()->id;
        $booklikes=Auth::user()->book_likes()->get();
        $books=collect();
        foreach ($booklikes as $booklike) {
            $books->push($booklike->book);
        }
        
        $perPage = 6;   // 1ページごとの表示件数
        $page = Paginator::resolveCurrentPage('page');
        $pageData = $books->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];
        $paginatedBooks = new LengthAwarePaginator($pageData, $books->count(), $perPage, $page, $options);   
        
        return view('books.booklike')->with(['books' => $paginatedBooks]);//$bookの中身を戻り値にする。
    }

    public function bookps(Request $request,Book $book)//インポートしたBookをインスタンス化して$bookとして使用。
    {
        $user_id=Auth::user()->id;
        $select = $request->orderNum;
        if(isset($select)) {
            switch($select) {
                case 1:
                    $sort='created_at';
                    $order='DESC';
                    break;
                case 2:
                    $sort='created_at';
                    $order='ASC';
                    break;
                case 3:
                    $sort='title';
                    $order='ASC';
                    break;
                case 4:
                    $sort='title';
                    $order='DESC';
                    break;    
            } 
        } else {
            $sort='created_at';
            $order='DESC';
        }
        
        $books = $book->orderBy($sort,$order)->where('user_id', $user_id)->paginate(6);
        return view('books.bookps')->with(['books' => $books]);//$bookの中身を戻り値にする。
    }//
     
    public function bookshow(Book $book)
    {
        $this->authorize('view', $book);
        $books = Book::withCount('book_likes');
        return view('books.bookshow')->with(['book' => $book, 'books'=>$books]);    
    }
    
    public function bookcteditshow(Book $book)
    {
        $this->authorize('view', $book);
        return view('books.bookcteditshow')->with(['book' => $book]);    
    }
    
    public function bookct(Book $book, Bookshelf $bookshelf,Category $category,Series $series)
    {
        // Auth::user()->categories()->get();
       // $user = auth()->user();
        $user_id=Auth::id();
        $books=Book::where('user_id', $user_id)->get();
        
        $unique_bookshelves=Auth::user()->bookshelves()->get();
        // dd($unique_bookshelves);
       
        $categories=Auth::user()->categories()->get();
        
        $series=Auth::user()->series()->get();
        return view('books.bookct')->with(['bookshelves' => $unique_bookshelves,'series_list' => $series,'categories' =>$categories]);
    }
    public function bookstore(BookpsRequest $request, Book $book,Bookshelf $bookshelf,Category $category,Series $series, User $user)
    {
        
        // dd($request);
        $input = $request['bookshelf']['bookshelf_input_name'];
        
        if($input == null ) { 
            $bookshelf_select_name = $request['bookshelf']['bookshelf_select_name'];
            // $bookshelf = Bookshelf::where('name', $bookshelf_select_name)->first();
            $bookshelf_id = $bookshelf_select_name;
        } else {
            $bookshelf_input_name = $input;
           // dd(DB::table('bookshelves')->where('user_id',Auth::id())->where('name', $bookshelf_input_name)->doesntExist());
            if(DB::table('bookshelves')->where('user_id',Auth::id())->where('name', $bookshelf_input_name)->doesntExist() ) {
                $input = ['name' => $bookshelf_input_name];
                $bookshelf_image_path = Cloudinary::upload($request->file('bookshelf_image_path')->getRealPath())->getSecurePath();
                $input += ['bookshelf_image_path' => $bookshelf_image_path];
                $input += ['user_id' => Auth::id()];
                $bookshelf->fill($input)->save(); 
                $bookshelf_id = $bookshelf -> latest('id')->first()->id;
                // $bookshelf->save();
                
            } else {
                $bookshelf = Bookshelf::where('name', $bookshelf_input_name)->where('user_id',Auth::id())->first();
                $bookshelf_id = $bookshelf->id;
            }
        } 
        
        $input = $request['category'];
        $user=Auth::user();
        
        // 入力欄にキーワードがあるか
        if($request['category_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $category_id = $request['category_select_name'];
            // $category = Category::where('name', $category_select_name)->first();
            
        } else {
            // キーワードある場合
            $category_input_name = $request['category_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('categories')->where('name', $category_input_name)->doesntExist()) {
                // ない場合
                $category->name =$category_input_name;
                $category->save();
                $category->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $category = Category::where('name',$category_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('category_user')->where('category_id', $category->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $category->users()->attach($user->id);
                    // $category = Category::where('name',$category_input_name)->first();
                } 
                // $category = Category::where('name', $category_input_name)->first();
            }
            $category_id = $category->id;
        } 
        
        $input = $request['series'];
        
        // 入力欄にキーワードがあるか
        if($request['series_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $series_id = $request['series_select_name'];
            // $series = series::where('name', $series_select_name)->first();
            
        } else {
            // キーワードある場合
            $series_input_name = $request['series_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('series')->where('name', $series_input_name)->doesntExist()) {
                // ない場合
                $series->name =$series_input_name;
                $series->save();
                $series->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $series = series::where('name',$series_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('series_user')->where('series_id', $series->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $series->users()->attach($user->id);
                    // $series = series::where('name',$series_input_name)->first();
                } 
                // $series = series::where('name', $series_input_name)->first();
            }
            $series_id = $series->id;
        } 
        
        
        $input = $request['book'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        $input['user_id'] = Auth::id();
        $input += ['bookshelf_id' => $bookshelf_id];
        $input['category_id'] = $category_id;
        $input['series_id'] = $series_id;
        $book->fill($input)->save();
        return redirect('/books/ctedit/' . $book->id);    
        
    }
    public function bookedit(Book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        $user_id=Auth::id();
        $books=Book::where('user_id', $user_id)->get();
        
        $unique_bookshelves=Auth::user()->bookshelves()->get();
        //dd($unique_bookshelves);
        $categories=Auth::user()->categories()->get();
        
        $series=Auth::user()->series()->get();
        
        return view('books.bookedit')->with(['book' => $book,'bookshelves' => $unique_bookshelves,'categories' => $categories,'series_list' => $series]);
    }
    
    public function bookupdate(BookpsRequest $request, Book $book,Bookshelf $bookshelf,Category $category,Series $series, User $user)
    {
        // dd($request);
        $input = $request['bookshelf']['bookshelf_input_name'];
        
        if($input == null ) { 
            $bookshelf_select_name = $request['bookshelf']['bookshelf_select_name'];
            // $bookshelf = Bookshelf::where('name', $bookshelf_select_name)->first();
            $bookshelf_id = $bookshelf_select_name;
        } else {
            $bookshelf_input_name = $input;
           // dd(DB::table('bookshelves')->where('user_id',Auth::id())->where('name', $bookshelf_input_name)->doesntExist());
            if(DB::table('bookshelves')->where('user_id',Auth::id())->where('name', $bookshelf_input_name)->doesntExist() ) {
                $input = ['name' => $bookshelf_input_name];
                $bookshelf_image_path = Cloudinary::upload($request->file('bookshelf_image_path')->getRealPath())->getSecurePath();
                $input += ['bookshelf_image_path' => $bookshelf_image_path];
                $input += ['user_id' => Auth::id()];
                $bookshelf->fill($input)->save(); 
                $bookshelf_id = $bookshelf -> latest('id')->first()->id;
                // $bookshelf->save();
                
            } else {
                $bookshelf = Bookshelf::where('name', $bookshelf_input_name)->where('user_id',Auth::id())->first();
                $bookshelf_id = $bookshelf->id;
            }
        } 
        
        $input = $request['category'];
        $user=Auth::user();
        
        // 入力欄にキーワードがあるか
        if($request['category_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $category_id = $request['category_select_name'];
            // $category = Category::where('name', $category_select_name)->first();
            
        } else {
            // キーワードある場合
            $category_input_name = $request['category_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('categories')->where('name', $category_input_name)->doesntExist()) {
                // ない場合
                $category->name =$category_input_name;
                $category->save();
                $category->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $category = Category::where('name',$category_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('category_user')->where('category_id', $category->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $category->users()->attach($user->id);
                    // $category = Category::where('name',$category_input_name)->first();
                } 
                // $category = Category::where('name', $category_input_name)->first();
            }
            $category_id = $category->id;
        } 
        
        $input = $request['series'];
        
        // 入力欄にキーワードがあるか
        if($request['series_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $series_id = $request['series_select_name'];
            // $series = series::where('name', $series_select_name)->first();
            
        } else {
            // キーワードある場合
            $series_input_name = $request['series_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('series')->where('name', $series_input_name)->doesntExist()) {
                // ない場合
                $series->name =$series_input_name;
                $series->save();
                $series->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $series = series::where('name',$series_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('series_user')->where('series_id', $series->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $series->users()->attach($user->id);
                    // $series = series::where('name',$series_input_name)->first();
                } 
                // $series = series::where('name', $series_input_name)->first();
            }
            $series_id = $series->id;
        } 
        
        $input = $request['book'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        $input['user_id'] = Auth::id();
        $input += ['bookshelf_id' => $bookshelf_id];
        $input['category_id'] = $category_id;
        $input['series_id'] = $series_id;
        $book->fill($input)->save();
        return redirect('/books/ctedit/' . $book->id); 
    }
    
     public function book_like(Request $request)
{
    // dd($request);
    $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
    $book_id = $request->book_id; // 投稿のidを取得
    
    // すでにいいねがされているか判定するためにlikesテーブルから1件取得
    $already_liked = BookLike::where('user_id', $user_id)->where('book_id', $book_id)->first(); 
    
    if (!$already_liked) { 
        $like = new BookLike; // Likeクラスのインスタンスを作成
        // $like = save();
        // $blog->users()->attach($user_id);
        $like->book_id = $book_id;
        $like->user_id = $user_id;
        $like->save();
        // $like->fill(['blog_id'=>$blog_id, 'user_id'=>$user_id])->save();
     } else {
        // 既にいいねしてたらdelete 
        BookLike::where('book_id', $book_id)->where('user_id', $user_id)->delete();
    }
    // 投稿のいいね数を取得
    $book_likes_count = Book::withCount('book_likes')->findOrFail($book_id)->book_likes_count;
    $param = [
        'book_likes_count' => $book_likes_count,
    ];
    //  $param = ['blog_likes_count'=>$like->user_id];
    return response()->json($param); // JSONデータをjQueryに返す
}
    
    public function bookdelete(Book $book)
    {
        //$category=Category::find($book->category_id);
        $book->delete();
        //$category->users()->detach(Auth::id());
        
        // if(Book::where('user_id',Auth::id())->where('category_id', $category_id)->doesntExist()) {
        //     Category::where('id',$category_id)->de
        // }
        // dd(Book::where('category_id', $category_id)->exists());
        return redirect('/books/bookps');
    }

}
