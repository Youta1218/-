<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        ];
    }
    public function messages()
    {
        return [
            'book.title.required' => 'タイトル未入力',
            'book.author.required' => '作者未入力',
        ];
    }
}
