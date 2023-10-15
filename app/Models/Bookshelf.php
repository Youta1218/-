<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
            'name',
            'bookshelf_image_path'
            ];
    
    public function books()   
    {
        
        return $this->hasMany(Book::class);  
    }
    public function getByBookshelf(int $limit_count = 10)
    {
         return $this->books()->with('bookshelf')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
