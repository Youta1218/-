<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\SeriesController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(BookController::class)->middleware(['auth'])->group(function(){
Route::get('/', 'home')->name('HOME');
Route::put('/books/update/{book}', 'bookupdate');
Route::post('/books', 'bookstore');
Route::get('/books/booklike', 'booklike')->name('お気に入り');
Route::get('/books/bookps', 'bookps')->name('ALL');
Route::get('/books/bookct', 'bookct')->name('本情報登録');
Route::get('/books/{book}', 'bookshow');
Route::get('/books/{book}/bookedit', 'bookedit');
Route::post('/books/like', 'book_like');
Route::delete('/books/{book}', 'bookdelete');    
});

Route::controller(BlogController::class)->middleware(['auth'])->group(function(){
Route::put('/blogs/update/{blog}', 'blogupdate');
Route::post('/blogs', 'blogstore');
Route::get('/blogmypg', 'blogmypg')->name('MY BLOG');
Route::get('/blogs/blogps', 'blogps')->name('BLOG');
Route::get('/blogs/blogct', 'blogct')->name('ブログ投稿');
Route::get('/blogs/{blog}', 'blogshow');
Route::get('/blogs/{blog}/blogedit', 'blogedit');
Route::post('/blogs/like', 'blog_like');
Route::delete('/blogs/{blog}', 'blogdelete');
});


Route::controller(CategoryController::class)->middleware(['auth'])->group(function(){
    Route::get('/categories/{category}' , 'category');
    Route::get('/categories' , 'categoryps')->name('カテゴリー');
});

Route::controller(BookshelfController::class)->middleware(['auth'])->group(function(){
    Route::get('/bookshelves/{bookshelf}' , 'bookshelf');
    Route::get('/bookshelves' , 'bookshelfps')->name('本棚');
    Route::get('/bookshelf/{bookshelf}/bookshelfedit', 'bookshelfedit');
    Route::put('/bookshelf/update/{bookshelf}', 'bookshelfupdate');
});

Route::controller(SeriesController::class)->middleware(['auth'])->group(function(){
    Route::get('/series/{series}' , 'series');
    Route::get('/series' , 'seriesps')->name('シリーズ');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
