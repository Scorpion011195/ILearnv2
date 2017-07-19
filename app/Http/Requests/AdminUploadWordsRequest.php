<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUploadWordsRequest extends FormRequest
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
            'fileWordsUpload' => 'required|mimes:txt|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'fileWordsUpload.required' => 'Bạn chưa chọn file!',
            'fileWordsUpload.mimes' => 'File không đúng định dạng txt!',
            'fileWordsUpload.max' => 'Dung lượng file không vượt quá 10000kb'
        ];
    }
}
