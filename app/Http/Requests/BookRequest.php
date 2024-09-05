<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $bookId = $this->route('book') ? $this->route('book')->id : null;

        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'author_id' => [
                'required',
                'exists:authors,id'
            ],
            'isbn' => [
                'required',
                'unique:books,isbn,' . $bookId,
                'max:13'
            ],
            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,png,jpeg',
                'max:2048'
            ],
            'bookstores' => [
                'required',
                'string'
            ], // Artık array değil string bekliyo
        ];

    }



    /**
     * Custom error messages for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'isbn.unique' => 'Bu ISBN numarası daha önce kullanılmış lütfen başka bir numara giriniz.',
            'bookstores.required' => 'En az bir satış noktası seçmelisiniz.',
            'bookstores.*.exists' => 'Seçilen satış noktalarından biri geçerli değil.',
        ];
    }
}
