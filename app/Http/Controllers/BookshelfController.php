<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;
use Auth;

class BookshelfController extends Controller
{
    public function bookshelf(Bookshelf $bookshelf)
    {
        $books=$bookshelf->books()->where('user_id', Auth::id())->orderBy('title', 'ASC')->paginate(6);
        //$this->authorize('view', $books->first());
    return view('books.bookshelf')->with(['books' => $books , 'bookshelf'=>$bookshelf]);
    }   
    public function bookshelfps (Bookshelf $bookshelf)
    {
        // $user_id=Auth::id();
        // $books=Book::where('user_id', $user_id)->get();
        // $bookshelves=collect([]);
        // foreach($books as $book) 
        // {
        //     $bookshelves->add($book->bookshelf);
        // }
        // $unique_bookshelves=$bookshelves->unique('id');
        $unique_bookshelves =Auth::user()->bookshelves()->orderBy('name', 'ASC')->paginate(6);
    return view('books.bookshelfps')->with(['bookshelves' => $unique_bookshelves]);
    }   
}
