<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //\BookpsRequest;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;

class BookController extends Controller
{
    public function home (Bookshelf $bookshelf,Category $category,Series $series)
    {
        return view('home')->with(['bookshelves' => $bookshelf->get(),'categories' => $category->get(),'series_list' => $series->get()]);
    }

    public function bookps(Book $book)//インポートしたBookをインスタンス化して$bookとして使用。
    {
        return view('books.bookps')->with(['books' => $book->getPaginateByLimit()]);//$bookの中身を戻り値にする。
    }//
    public function bookshow(Book $book)
    {
        return view('books.bookshow')->with(['book' => $book]);    
    }
    public function bookct(Bookshelf $bookshelf,Category $category,Series $series)
    {
        return view('books.bookct')->with(['bookshelves' => $bookshelf->get(),'categories' => $category->get(),'series_list' => $series->get()]);
    }
    public function store(Request $request, Book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        $input = $request['bookshelf'];
        $bookshelf->fill($input)->save();
        $input = $request['category'];
        $category->fill($input)->save();
        $input = $request['series'];
        $series->fill($input)->save();
        $input = $request['book'];
        $book->fill($input)->save();
        $book->bookshelf_id = $bookshelf->id;
        $book->category_id = $category->id;
        $book->series_id = $series->id;
        return redirect('/books/' . $book->id);    
        
    }
    public function bookedit(book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        return view('books.bookedit')->with(['book' => $book,'bookshelves' => $bookshelf,'categories' => $category,'series_list' => $series]);
    }
    public function bookupdate(BookpsRequest $request, Book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        $input = $request['bookshelf'];
        $bookshelf->fill($input)->save();
        $input = $request['category'];
        $category->fill($input)->save();
        $input = $request['series'];
        $series->fill($input)->save();
        $input = $request['book'];
        $book->fill($input)->save();
        $book->bookshelf_id = $bookshelf->id;
        $book->category_id = $category->id;
        $book->series_id = $series->id;

        return redirect('/books/' . $book->id);
    }
    

}
