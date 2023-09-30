<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;

class BookshelfController extends Controller
{
    public function bookshelf(Bookshelf $bookshelf , Book $book)
    {
        
    return view('books.bookshelf')->with(['books' => $bookshelf->getByCategory()]);
    }   
}
