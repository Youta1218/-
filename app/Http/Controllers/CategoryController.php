<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;
use Auth;

class CategoryController extends Controller
{
    public function category(Category $category)
    {
        $books=$category->getByCategory();
        $user_books =$books->whereIn("user_id", Auth::id());
        //$this->authorize('view', $user_books->first());
    return view('books.category')->with(['books' => $user_books, 'category'=>$category]);
    }   
    public function categoryps (Category $category)
    {
        $categories=Auth::user()->categories()->get();
        
        
    return view('books.categoryps')->with(['categories' => $categories]);
    }   
    
}
