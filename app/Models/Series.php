<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    
    public function books()   
    {
        return $this->hasMany(Book::class);  
    }
    public function blogs()   
    {
        return $this->hasMany(Blog::class);  
    }
}
