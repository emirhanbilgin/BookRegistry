<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Giriş yapmış kullanıcılara izin vermek için
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:authors,name'], // Yazar ismi doğrulaması
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Yazar adı zorunludur.',
            'name.unique' => 'Bu yazar adı daha önce eklenmiş.',
        ];
    }
}
