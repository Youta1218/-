<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function getPaginateByLimit(int $limit_count = 10)

    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    protected $fillable = [
    'user_id',
    'title',
    'author',
    'front_cover_image_path',
    'bookshelf_id',
    'category_id',
    'series_id'
    ];
    
<<<<<<< HEAD
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
=======

>>>>>>> c82e362871f605a9806cb95a1dffa8c2905af0e2
}
