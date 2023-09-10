<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\BookpsRequest;
use App\Models\Book;

class BookController extends Controller
{
    public function bookps(Book $book)//インポートしたBookをインスタンス化して$bookとして使用。
    {
        return view('books.bookps')->with(['books' => $book->getPaginateByLimit()]);//$bookの中身を戻り値にする。
    }//
    public function bookshow(Book $book)
    {
        return view('books.bookshow')->with(['book' => $book]);    
    }
    public function bookct()
    {
        return view('books.bookct');
    }
    public function store(Request $request, Book $book)
    {
        $input = $request['book'];
        $post->fill($input)->save();
        return redirect('/blogs/' . $book->id);
    }
    
}
