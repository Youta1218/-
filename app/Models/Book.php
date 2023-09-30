<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getPaginateByLimit(int $limit_count = 2)

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
}
