<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminGetProfileRequest extends FormRequest
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
            'name' => 'required|min:4|max:50',
            'password'=>'max:50'
        ];
    }

     public function messages()
    {
        return [
            // 'name.alpha_dash' => 'Chỉ nhập các kí tự là: chữ, số, "-", "_"',
            'name.required' => 'Bạn chưa nhập <strong>Tên</strong>',
            'name.min' => 'Tên phải có từ 4 kí tự',
            'name.max' => 'Tên phải nhỏ hơn 32 kí tự',
            'password.max' =>'Mật khẩu không quá 50 ký tự',
        ];
    }
}
