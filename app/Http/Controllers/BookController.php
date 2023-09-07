<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function Bookps(Book $book)//インポートしたBookをインスタンス化して$bookとして使用。
{
    return $book->get();//$bookの中身を戻り値にする。
}//
}
