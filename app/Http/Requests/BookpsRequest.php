<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class BookpsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'book.title' => 'required|string|max:100',
            'book.author' => 'required|string|max:4000',
            'front_cover_image_path' => 'required',
            'book.place' => 'required|string|max:100',
            // 'category_input_name' =>'unique:'.Category::class,
        ];
        
    }
    public function messages()
    {
        return [
            'book.title.required' => 'タイトル未入力',
            'book.author.required' => '作者未入力',
            'front_cover_image_path.required' => '写真未選択',
            'book.place.required' => '本の場所未入力',
        ];
    }
    
}
