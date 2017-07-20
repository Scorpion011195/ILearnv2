<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddWordRequest extends FormRequest
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
            'fromText' => 'required|max:50',
            'toText' => 'required|max:50',
            'pronoun' =>'max:50'
        ];
    }

    public function messages()
    {
        return [
            'fromText.required' => 'Bạn chưa nhập từ',
            'fromText.max' => 'Từ phải ít hơn 50 kí tự',
            'toText.required'  => 'Bạn chưa nhập nghĩa',
            'toText.max' => 'Nghĩa phải ít hơn 50 kí tự',
            'pronoun.max' => 'Phát âm phải ít hơn 50 ký tự'
        ];
    }
}
