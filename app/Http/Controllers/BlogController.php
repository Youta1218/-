<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //\BlogpsRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Series;
use App\Http\Requests\BlogpsRequest;
//use Auth;
use Cloudinary;
use Illuminate\Support\Facades\DB;
use App\Models\BlogLike;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function blogmypg(Blog $blog)//インポートしたBlogをインスタンス化して$blogとして使用。

    {
        $user_id=Auth::user()->id;
    return view('blogs.blogmypg')->with(['blogs' => $blog->where('user_id',$user_id)->orderBy('updated_at','DESC')->withCount('blog_likes')->paginate(6)]);
    //$blogの中身を戻り値にする。
    }
    
    public function blogps(Blog $blog)//インポートしたBlogをインスタンス化して$blogとして使用。

    {
        $user = auth()->user();
        $blogs = Blog::withCount('blog_likes')->orderBy('updated_at', 'DESC')->paginate(6);
        
    return view('blogs.blogps')->with(['blogs' => $blogs]);
    //$blogの中身を戻り値にする。
    }
    
    public function blogshow(Blog $blog)
    {
        $blogs = Blog::withCount('blog_likes');
        
        return view('blogs.blogshow')->with(['blog' => $blog, 'blogs'=>$blogs]);    
    }
    
    public function blogctedit(Blog $blog)
    {
        
        return view('blogs.blogcteditshow')->with(['blog' => $blog]);    
    }
    
    public function blogct(Blog $blog, Category $category,Series $series)
    {
        $user_id=Auth::id();
        $blogs=Blog::where('user_id', $user_id)->get();
       
        $categories=Auth::user()->categories()->get();
        
        $series=Auth::user()->series()->get();
        
        return view('blogs.blogct')->with(['categories' => $categories,'series_list' => $series]);
    }
    public function blogstore(BlogpsRequest $request, Blog $blog, Category $category,Series $series)
    {
        $input = $request['category'];
        $user=Auth::user();
        
        // 入力欄にキーワードがあるか
        if($request['category_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $category_id = $request['category_select_name'];
            // $category = Category::where('name', $category_select_name)->first();
            
        } else {
            // キーワードある場合
            $category_input_name = $request['category_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('categories')->where('name', $category_input_name)->doesntExist()) {
                // ない場合
                $category->name =$category_input_name;
                $category->save();
                $category->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $category = Category::where('name',$category_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('category_user')->where('category_id', $category->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $category->users()->attach($user->id);
                    // $category = Category::where('name',$category_input_name)->first();
                } 
                // $category = Category::where('name', $category_input_name)->first();
            }
            $category_id = $category->id;
        } 
        
        $input = $request['series'];
        
        // 入力欄にキーワードがあるか
        if($request['series_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $series_id = $request['series_select_name'];
            // $series = series::where('name', $series_select_name)->first();
            
        } else {
            // キーワードある場合
            $series_input_name = $request['series_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('series')->where('name', $series_input_name)->doesntExist()) {
                // ない場合
                $series->name =$series_input_name;
                $series->save();
                $series->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $series = series::where('name',$series_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('series_user')->where('series_id', $series->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $series->users()->attach($user->id);
                    // $series = series::where('name',$series_input_name)->first();
                } 
                // $series = series::where('name', $series_input_name)->first();
            }
            $series_id = $series->id;
        } 
        
        $input = $request['blog'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        $input['user_id'] = Auth::id();
        $input['category_id'] = $category_id;
        $input['series_id'] = $series_id;
        $blog->fill($input)->save();
        return redirect('/blogs/ctedit/' . $blog->id);
    }
    public function blogedit(Blog $blog,Category $category,Series $series)
    {
        return view('blogs.blogedit')->with(['blog' => $blog,'categories' => $category->get(),'series_list' => $series->get()]);
    }
    public function blogupdate(BlogpsRequest $request, Blog $blog, Category $category,Series $series)
    {
       $input = $request['category'];
        $user=Auth::user();
        
        // 入力欄にキーワードがあるか
        if($request['category_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $category_id = $request['category_select_name'];
            // $category = Category::where('name', $category_select_name)->first();
            
        } else {
            // キーワードある場合
            $category_input_name = $request['category_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('categories')->where('name', $category_input_name)->doesntExist()) {
                // ない場合
                $category->name =$category_input_name;
                $category->save();
                $category->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $category = Category::where('name',$category_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('category_user')->where('category_id', $category->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $category->users()->attach($user->id);
                    // $category = Category::where('name',$category_input_name)->first();
                } 
                // $category = Category::where('name', $category_input_name)->first();
            }
            $category_id = $category->id;
        } 
        
        $input = $request['series'];
        
        // 入力欄にキーワードがあるか
        if($request['series_input_name'] == null ) { 
            // セレクトからデータ受け取り
            $series_id = $request['series_select_name'];
            // $series = series::where('name', $series_select_name)->first();
            
        } else {
            // キーワードある場合
            $series_input_name = $request['series_input_name'];
            
            
            // カテゴリーテーブルにあるか
            if( DB::table('series')->where('name', $series_input_name)->doesntExist()) {
                // ない場合
                $series->name =$series_input_name;
                $series->save();
                $series->users()->attach($user->id);
  
            } else {
                
                // ある場合 
                $series = series::where('name',$series_input_name)->first();
                
                // 中間テーブルにあるか
                if(DB::table('series_user')->where('series_id', $series->id)->where('user_id',$user->id)->doesntExist() ) {
                    // ない
                    $series->users()->attach($user->id);
                    // $series = series::where('name',$series_input_name)->first();
                } 
                // $series = series::where('name', $series_input_name)->first();
            }
            $series_id = $series->id;
        } 
        
        $input = $request['blog'];
        $front_cover_image_path = Cloudinary::upload($request->file('front_cover_image_path')->getRealPath())->getSecurePath();
        $input += ['front_cover_image_path' => $front_cover_image_path];
        $input['user_id'] = Auth::id();
        $input['category_id'] = $category_id;
        $input['series_id'] = $series_id;
        $blog->fill($input)->save();
        
        return redirect('/blogs/ctedit/' . $blog->id);
    }
    
    public function blog_like(Request $request)
{
    // dd($request);
    $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
    $blog_id = $request->blog_id; // 投稿のidを取得
    
    // すでにいいねがされているか判定するためにlikesテーブルから1件取得
    $already_liked = BlogLike::where('user_id', $user_id)->where('blog_id', $blog_id)->first(); 
    
    if (!$already_liked) { 
        $like = new BlogLike; // Likeクラスのインスタンスを作成
        // $like = save();
        // $blog->users()->attach($user_id);
        $like->blog_id = $blog_id;
        $like->user_id = $user_id;
        $like->save();
        // $like->fill(['blog_id'=>$blog_id, 'user_id'=>$user_id])->save();
     } else {
        // 既にいいねしてたらdelete 
        BlogLike::where('blog_id', $blog_id)->where('user_id', $user_id)->delete();
    }
    // 投稿のいいね数を取得
    $blog_likes_count = Blog::withCount('blog_likes')->findOrFail($blog_id)->blog_likes_count;
    $param = [
        'blog_likes_count' => $blog_likes_count,
    ];
    //  $param = ['blog_likes_count'=>$like->user_id];
    return response()->json($param); // JSONデータをjQueryに返す
}
    
    public function blogdelete(Blog $blog)
    {
        $blog->delete();
        return redirect('/blogmypg');
    }
}
