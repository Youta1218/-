<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookController;

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
//Route::get('/blogs', [BlogController::class, 'blogps']);
Route::get('/', [BlogController::class, 'blogps']);
Route::get('/blogs/blogct', [BlogController::class, 'blogct']);
Route::get('/blogs/{blog}', [BlogController::class ,'blogshow']);
Route::get('/blogs/{blog}/blogedit', [BlogController::class, 'blogedit']);
Route::put('/blogs/{blog}', [BlogController::class, 'blogupdate']);
Route::delete('/blogs/{blog}', [BlogController::class,'blogdelete']);

Route::get('/', [BookController::class, 'Bookps']);
Route::get('/books/bookct', [BookController::class, 'bookct']);
Route::get('/books/{book}', [BookController::class ,'bookshow']);
Route::get('/books/{book}/bookedit', [BookController::class, 'bookedit']);
Route::put('/books/{book}', [BookController::class, 'bookupdate']);
Route::delete('/books/{book}', [BookController::class,'bookdelete']);    
/**Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';**/
