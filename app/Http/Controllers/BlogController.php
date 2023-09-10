<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\BlogpsRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blogps(Blog $blog)//インポートしたBlogをインスタンス化して$blogとして使用。
    {
    return view('blogs.bogps')->with(['blogs' => $blog->getPaginateByLimit()]);
    //$blogの中身を戻り値にする。
    }
    public function blogshow(Blog $blog)
    {
        return view('blogs.blogshow')->with(['blog' => $blog]);    
    }
    public function blogct()
    {
        return view('blogs.blogct');
    }
    public function store(Request $request, Blog $blog)
    {
        $input = $request['blog'];
        $blog->fill($input)->save();
        return redirect('/blogs/' . $blog->id);
    }
}
