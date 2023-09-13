<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //\BlogpsRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Series;

class BlogController extends Controller
{
    public function blogps(Blog $blog)//インポートしたBlogをインスタンス化して$blogとして使用。
    {
    return view('blogs.blogps')->with(['blogs' => $blog->getPaginateByLimit()]);
    //$blogの中身を戻り値にする。
    }
    public function blogshow(Blog $blog)
    {
        return view('blogs.blogshow')->with(['blog' => $blog]);    
    }
    public function blogct(Category $category,Series $series)
    {
        return view('blogs.blogct')->with(['categories' => $category->get(),'series_list' => $series->get()]);
    }
    public function store(Request $request, Blog $blog, Category $category,Series $series)
    {
        $input = $request['category'];
        $category->fill($input)->save();
        $input = $request['series'];
        $series->fill($input)->save();
        $input = $request['blog'];
        $blog->fill($input)->save();
        $blog->category_id = $category->id;
        $blog->series_id = $series->id;
        return redirect('/blogs/' . $blog->id);
    }
    public function blogedit(Blog $blog,Category $category,Series $series)
    {
        return view('blogs.blogedit')->with(['blog' => $blog,'categories' => $category,'series_list' => $series]);
    }
    public function blogupdate(BlogpsRequest $request, Blog $blog, Category $category,Series $series)
    {
        $input = $request['category'];
        $category->fill($input)->save();
        $input = $request['series'];
        $series->fill($input)->save();
        $input = $request['blog'];
        $blog->fill($input)->save();
        $blog->category_id = $category->id;
        $blog->series_id = $series->id;

        return redirect('/blogs/' . $blog->id);
    }
}
