<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name'
        ];
    
    public function getPaginateByLimit(int $limit_count = 8)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('name')->paginate($limit_count);
    }
    
    public function books()   
    {
        return $this->hasMany(Book::class);  
    }
    public function blogs()   
    {
        return $this->hasMany(Blog::class);  
    }
    public function users()   
    {
        return $this->belongsToMany(User::class);  
    }
    
    public function getByCategory(int $limit_count = 8)
    {
         return $this->books()->with('category')->orderBy('title')->paginate($limit_count);
    }
    
    public function getBookCount()
    {
        return $this->books()->where('user_id',Auth::id())->count();
    }
}
