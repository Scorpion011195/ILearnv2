<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'username' => 'alpha_dash|required|min:6|max:32',
            'password' => 'required|min:6|max:32'
        ];
    }

    public function messages()
    {
        return [
            'username.alpha_dash' => 'Chỉ nhập các kí tự là: chữ, số, "-", "_"',
            'username.required' => 'Bạn chưa nhập Username',
            'username.min' => 'Username phải có từ 6 kí tự',
            'username.max' => 'Username phải nhỏ hơn 32 kí tự',
            'password.required'  => 'Bạn chưa nhập Password',
            'password.min' => 'Password phải có từ 6 kí tự',
            'password.max' => 'Mật khẩu phải nhỏ hơn 32 kí tự',
        ];
    }
}
