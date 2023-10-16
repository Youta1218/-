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
        
        $user_books = $category->books()->where('user_id', Auth::id())->orderBy('title', 'ASC')->paginate(6);
        // dd($category->books()->where('user_id', Auth::id())->get());
        // foreach ($books as $book) {
        //     $user_books += [$book->where('user_id', Auth::id())->first()];
            
        // }
        //$this->authorize('view', $user_books->first());
    return view('books.category')->with(['books' => $user_books, 'category'=>$category]);
    }   
    public function categoryps (Category $category)
    {
        $categories=Auth::user()->categories()->orderBy('name', 'ASC')->paginate(9);
        
        
    return view('books.categoryps')->with(['categories' => $categories]);
    }   
    
}
