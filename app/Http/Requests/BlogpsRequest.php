<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogpsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'blog.book_title' => 'required|string|max:100',
            'blog.author' => 'required|string|max:4000',
            'front_cover_image_path' => 'required',
            'blog.blog_title' => 'required|string|max:100',
            'blog.blog_body' => 'required|string|max:4000',
        ];
    } 
    
    public function messages()
    {
        return [
            'blog.blog_title.required' => 'ブログタイトル未入力',
            'blog.author.required' => '作者未入力',
            'front_cover_image_path.required' => '写真未選択',
            'blog.book_title.required' => '本タイトル未入力',
            'blog.blog_body.required' => '本文未入力',
            'blog.author.required' => '作者未入力',
        ];
    }
}
