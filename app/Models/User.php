<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function books()   
    {
        return $this->hasMany(Book::class);  
    }
    public function blogs()   
    {
        return $this->hasMany(Blog::class);  
    }
    public function categories()   
    {
        return $this->belongsToMany(Category::class);  
    }
    public function series()   
    {
        return $this->belongsToMany(Series::class);  
    }
    public function bookshelves()   
    {
        return $this->hasMany(Bookshelf::class);  
    }
    
    // 実装1
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    
    // 実装2
    public function blog_likes()
    {
        return $this->hasMany(BlogLike::class);
    }
    // 実装1
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    // 実装2
    public function book_likes()
    {
        return $this->hasMany(BookLike::class);
    }
    
}
