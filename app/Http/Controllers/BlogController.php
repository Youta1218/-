<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //\BlogpsRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Series;
use App\Http\Requests\BlogpsRequest;
use Auth;
use Cloudinary;
use Illuminate\Support\Facades\DB;

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
    public function blogstore(Request $request, Blog $blog, Category $category,Series $series)
    {
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
        $input = $request['blog'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        $input['user_id'] = Auth::id();
        $input['category_id'] = $category->id;
        $input['series_id'] = $series->id;
        $blog->fill($input)->save();
        return redirect('/blogs/' . $blog->id);
    }
    public function blogedit(Blog $blog,Category $category,Series $series)
    {
        return view('blogs.blogedit')->with(['blog' => $blog,'categories' => $category->get(),'series_list' => $series->get()]);
    }
    public function blogupdate(Request $request, Blog $blog, Category $category,Series $series)
    {
        // dd($request);
        $input = $request['category'];
        if($request['category_input_name'] == null ) { 
            $category_select_name = $request['category_select_name'];
            $category = Category::where('name', $category_select_name)->first();
        } else {
            $category_input_name = $request['category_input_name'];
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
            if(DB::table('series')->where('name', $series_input_name)->doesntExist()) {
            $series->name =$series_input_name;
            $series->save();
            } else {
                $series = Series::where('name', $series_input_name)->first();
            }
        }
        $blog->category_id = $category->id;
        $blog->series_id = $series->id;
        
        $input = $request['blog'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        
        $blog->fill($input)->save();
        
        return redirect('/blogs/' . $blog->id);
    }
    public function blogdelete(Blog $blog)
    {
        $blog->delete();
        return redirect('/');
    }
}
