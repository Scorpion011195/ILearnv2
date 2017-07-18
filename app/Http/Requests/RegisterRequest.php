<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
            'email' => 'required|email|unique:users,email',
            'password' =>'required|min:6|max:32',
            'confirm-password' =>'required|same:password',
            'username' => 'alpha_dash|required|unique:users,username'
        ];
    }

    public function messages()
    {
        return [
        'email.required' => 'Trường email là bắt buộc',
        'email.email' => 'Bạn chưa nhập đúng định dạng email',
        'email.unique' => 'Email này đã tồn tại',
        'password.required' => 'Mật khẩu là bắt buộc',
        'password.min' => 'Mật khẩu lớn hơn 6 kí tự',
        'password.max' => 'Mật khẩu nhỏ hơn 32 kí tự',
        'confirm-password.required' => 'Nhập lại mật khẩu',
        'confirm-password.same' => 'Mật khẩu nhập lại chưa khớp',
        'username.unique' => 'username này đã tồn tại',
        'username.required' => 'Trường username là bắt buộc',
        'username.alpha_dash' => 'Chỉ nhập các kí tự là: chữ, số, "-", "_"'
        ];
    }
}