<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'passwordOld' => 'nullable|min:6|max:32',
            'password' =>'nullable|min:6|max:32',
            'confirm_password' =>'nullable|same:password',
        ];
    }

    public function messages()
    {
        return [
        'passwordOld.min' => 'Mật khẩu lớn hơn 6 kí tự',
        'passwordOld.max' => 'Mật khẩu nhỏ hơn 32 kí tự',
        'password.min' => 'Mật khẩu lớn hơn 6 kí tự',
        'password.max' => 'Mật khẩu nhỏ hơn 32 kí tự',
        'confirm_password.same' => 'Mật khẩu nhập lại chưa khớp',
        ];
    }
}