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
        $books=$series->getBySeries();
        $user_books = $books->whereIn("user_id", Auth::id());
        $this->authorize('view', $user_books->first());
    return view('books.series')->with(['books' => $user_books, 'series'=>$series]);
    }   
    public function seriesps (Series $series)
    {
        $series=Auth::user()->series()->get();
    return view('books.seriesps')->with(['series_list' => $series]);
    }   
}
