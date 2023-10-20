<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getPaginateByLimit($user_id,int $limit_count = 6)

    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->where('user_id', $user_id)->orderBy('title')->paginate($limit_count);
    }

    protected $fillable = [
    'user_id',
    'title',
    'author',
    'front_cover_image_path',
    'bookshelf_id',
    'place',
    'category_id',
    'series_id'
    ];
    
     public function user()   
    {
        return $this->belongsTo(User::class);  
    }
    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function series()
    {
        return $this->belongsTo(Series::class);
    }
    public function book_likes()
    {
        return $this->hasMany('App\Models\BookLike');
    }
    // Viewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
        return BookLike::where('user_id', $user->id)->where('book_id', $this->id)->first() !==null;
    }
    
}
