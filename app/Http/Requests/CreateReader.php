<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReader extends FormRequest
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
        return [
            'nick' => 'required|min:3|max:100|regex:/[a-zA-Z0-9]+/i',
            'book' => 'required|max:255|regex:/[a-zA-Z0-9]+/i'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nick.required' => __('Prosimy o uzupenienie pola Nick'),
            'nick.min' => __('Nick powinien zawierać minimalnie 3 znaki'),
            'nick.max' => __('Nick powinien zawierać maksymalnie 100 znaków'),
            'nick.regex' => __('Wartość wpisana w polu Nick jest niepoprawna'),
            'book.required'  => __('Prosimy o uzupenienie pola książka'),
            'book.max'  => __('Książka powinna zawierać maksymaline 255 znaków'),
            'book.regex'  => __('Wartość wpisana w polu Książka jest niepoprawna'),
        ];
    }
}
