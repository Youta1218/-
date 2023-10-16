<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Series extends Model
{
    use HasFactory;
   // protected $table = series;
    
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
    public function users()   
    {
        return $this->belongsToMany(User::class);  
    }
    public function getBySeries(int $limit_count = 10)
    {
         return $this->books()->with('series')->orderBy('title')->paginate($limit_count);
    }
    
    public function getBookCount()
    {
        return $this->books()->where('user_id',Auth::id())->count();
    }
}
