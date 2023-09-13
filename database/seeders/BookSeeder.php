<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
        'user_id' => 1,
        'title' => '命名の心得',
        'author' => '筆者',
        'front_cover_image_path' => 'pic',
        'bookshelf_id' =>1,
        'category_id' => 1,
        'series_id' => 1,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
        'deleted_at' => new DateTime(),    
        ]);
        
    }
}
