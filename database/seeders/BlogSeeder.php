<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /DB::table('blogs')->insert([
                'user_id' => 1,
                'book_title' => '命名の心得',
                'author' => '筆者',
                'front_cover_image_path' => 'pic',
                'category_id' => 1,
                'series_id' => 1,
                'blog_title' => '命名の心得',
                'blog_body' => '命名はデータを基準に考える',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at' => new DateTime(),
         ]);
    }
}
