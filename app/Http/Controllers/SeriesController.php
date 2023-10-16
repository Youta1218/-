<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;
use Auth;


class SeriesController extends Controller
{
    public function series(Series $series)
    {
        $user_books = $series->books()->where('user_id', Auth::id())->orderBy('title', 'ASC')->paginate(6);
        
    return view('books.series')->with(['books' => $user_books, 'series'=>$series]);
    }   
    public function seriesps (Series $series)
    {
        $series=Auth::user()->series()->orderBy('name', 'ASC')->paginate(9);
    return view('books.seriesps')->with(['series_list' => $series]);
    }   
}
