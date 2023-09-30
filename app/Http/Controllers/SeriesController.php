<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;


class SeriesController extends Controller
{
    public function series(Series $series , Book $book)
    {
        
    return view('books.series')->with(['books' => $series->getByCategory()]);
    }   
}
