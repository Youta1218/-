<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;

class CategoryController extends Controller
{
    public function category(Category $category , Book $book)
    {
        
    return view('books.category')->with(['books' => $category->getByCategory()]);
    }   
}
