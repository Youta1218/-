<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name'
        ];
    
    public function books()   
    {
        return $this->hasMany(Book::class);  
    }
    public function blogs()   
    {
        return $this->hasMany(Blog::class);  
    }
    public function getByCategory(int $limit_count = 10)
    {
         return $this->books()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
