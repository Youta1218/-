<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //\BookpsRequest;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\Series;
use App\Http\Requests\BookpsRequest;
use Auth;
use Cloudinary;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function home (Bookshelf $bookshelf,Category $category,Series $series)
    {
        //$series_list = Series::all();
        // dd($series_list);
        return view('home')->with(['bookshelves' => $bookshelf->get(),'categories' => $category->get(),'series_list' => $series->get()]);
    }

    public function bookps(Book $book)//インポートしたBookをインスタンス化して$bookとして使用。
    {
        return view('books.bookps')->with(['books' => $book->getPaginateByLimit()]);//$bookの中身を戻り値にする。
    }//
        public function bookshelf(Book $book)
    {
        return view('books.bookshelf')->with(['books' => $book->get()]);    
    }
    public function bookshow(Book $book)
    {
        return view('books.bookshow')->with(['book' => $book]);    
    }
    
    public function bookct(Bookshelf $bookshelf,Category $category,Series $series)
    {
        return view('books.bookct')->with(['bookshelves' => $bookshelf->get(),'categories' => $category->get(),'series_list' => $series->get()]);
    }
    public function bookstore(BookpsRequest $request, Book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        
        // dd($request);
        $input = $request['bookshelf'];
        // dd($request);
        
        if($request['bookshelf']['bookshelf_input_name'] == null ) { 
            $bookshelf_select_name = $request['bookshelf']['bookshelf_select_name'];
            $bookshelf = Bookshelf::where('name', $bookshelf_select_name)->first();
            
            $bookshelf_id = $bookshelf ->id;
            
        } else {
            $bookshelf_input_name = $request['bookshelf']['bookshelf_input_name'];
           // $bookshelf->name =$bookshelf_input_name;
            $input += ['name' => $bookshelf_input_name];
            $bookshelf_image_path = Cloudinary::upload($request->file('bookshelf_image_path')->getRealPath())->getSecurePath();
            $input += ['bookshelf_image_path' => $bookshelf_image_path];
            $bookshelf->fill($input)->save();
            $bookshelf_id = $bookshelf -> latest('id')->first()->id;
        } 
        // dd($bookshelf);
        $input = $request['category'];
        if($request['category_input_name'] == null ) { 
            $category_select_name = $request['category_select_name'];
            $category = Category::where('name', $category_select_name)->first();
        } else {
            $category_input_name = $request['category_input_name'];
            $category->name =$category_input_name;
            $category->save();
            
        } 
        
        $input = $request['series'];
        if($request['series_input_name'] == null ) { 
            $series_select_name = $request['series_select_name'];
            $series = Series::where('name', $series_select_name)->first();
        } else {
            $series_input_name = $request['series_input_name'];
            $series->name =$series_input_name;
             $series->save();
            
        } 
        
        $input = $request['book'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        $input['user_id'] = Auth::id();
        $input += ['bookshelf_id' => $bookshelf_id];
        $input['category_id'] = $category->id;
        $input['series_id'] = $series->id;
        $book->fill($input)->save();
        return redirect('/books/' . $book->id);    
        
    }
    public function bookedit(book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        return view('books.bookedit')->with(['book' => $book,'bookshelves' => $bookshelf->get(),'categories' => $category->get(),'series_list' => $series->get()]);
    }
    public function bookupdate(Request $request, Book $book,Bookshelf $bookshelf,Category $category,Series $series)
    {
        // dd($request);
        $input = $request['bookshelf'];
        if($request['bookshelf']['bookshelf_input_name'] == null ) { 
            $bookshelf_select_name = $request['bookshelf']['bookshelf_select_name'];
            $bookshelf = Bookshelf::where('name', $bookshelf_select_name)->first();
            
            $bookshelf_id = $bookshelf ->id;
            
        } else {
            $bookshelf_input_name = $request['bookshelf']['bookshelf_input_name'];
           // $bookshelf->name =$bookshelf_input_name;
           
            if(DB::table('bookshelves')->where('name', $bookshelf_input_name)->doesntExist() ) {
                $input += ['name' => $bookshelf_input_name];
               $bookshelf_image_path = Cloudinary::upload($request->file('bookshelf_image_path')->getRealPath())->getSecurePath();
                $input += ['bookshelf_image_path' => $bookshelf_image_path];
                $bookshelf->fill($input)->save(); 
                // $bookshelf->save();
                
            } else {
                $bookshelf = Bookshelf::where('name', $bookshelf_input_name)->first();
            }
            // $bookshelf_image_path = Cloudinary::upload($request->file('bookshelf_image_path')->getRealPath())->getSecurePath();
            // $input += ['bookshelf_image_path' => $bookshelf_image_path];
            // $bookshelf->fill($input)->save();
            $bookshelf_id = $bookshelf -> latest('id')->first()->id;
        } 
        
        $input = $request['category'];
        if($request['category_input_name'] == null ) { 
            $category_select_name = $request['category_select_name'];
            $category = Category::where('name', $category_select_name)->first();
        } else {
            $category_input_name = $request['category_input_name'];
            // 
            if(DB::table('categories')->where('name', $category_input_name)->doesntExist() ) {
                $category->name =$category_input_name;
                $category->save();
                
            } else {
                $category = Category::where('name', $category_input_name)->first();
            }
        } 
        
        $input = $request['series'];
        if($request['series_input_name'] == null ) { 
            $series_select_name = $request['series_select_name'];
            $series = Series::where('name', $series_select_name)->first();
        } else {
            $series_input_name = $request['series_input_name'];
            if(DB::table('series')->where('name', $series_input_name)->doesntExist() ) {
                
                $series->name =$series_input_name;
                $series->save();
            } else {
                $series = Series::where('name', $series_input_name)->first();
            }
        } 
        
        $book->bookshelf_id = $bookshelf->id;
        $book->category_id = $category->id;
        $book->series_id = $series->id;
        
        $input = $request['book'];
        $book->fill($input)->save();
        
        
 
        return redirect('/books/' . $book->id);
    }
    public function bookdelete(Book $book)
    {
        $book->delete();
        return redirect('/');
    }

}
