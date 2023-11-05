<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;
use Auth;
use Cloudinary;

class BookshelfController extends Controller
{
    public function bookshelf(Request $request,Bookshelf $bookshelf)
    {
         $user_id=Auth::user()->id;
        $select = $request->orderNum;
        if(isset($select)) {
            switch($select) {
                case 1:
                    $sort='created_at';
                    $order='ASC';
                    break;
                case 2:
                    $sort='created_at';
                    $order='DESC';
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
            $order='ASC';
        }
        $books=$bookshelf->books()->where('user_id', Auth::id())->orderBy($sort, $order)->paginate(6);
        //$this->authorize('view', $books->first());
    return view('books.bookshelf')->with(['books' => $books , 'bookshelf'=>$bookshelf,'orderNum' => $select]);
    }   
    public function bookshelfps (Bookshelf $bookshelf)
    {
        $unique_bookshelves =Auth::user()->bookshelves()->orderBy('name', 'ASC')->paginate(6);
    return view('books.bookshelfps')->with(['bookshelves' => $unique_bookshelves]);
    }   
    
     public function bookshelfedit(Bookshelf $bookshelf)
    {
        // $user_id=Auth::id();
        
        // $unique_bookshelves=Auth::user()->bookshelves()->get();
        
        return view('books.bookshelfedit')->with(['bookshelf' => $bookshelf]);
    }
    
    public function bookshelfupdate(Request $request,Bookshelf $bookshelf)
    {
        $user_id=Auth::id();
        
        $input = $request['bookshelf'];
        $bookshelf_image_path = Cloudinary::upload($request->file('bookshelf_image_path')->getRealPath())->getSecurePath();
        $input += ['bookshelf_image_path' => $bookshelf_image_path];
        $input['user_id'] = $user_id;
        $bookshelf->fill($input)->save();    
        return redirect('/bookshelves');
    }
}
