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
            'name' => 'required|min:4|max:50|alpha',
            'phone' =>'min:10|regex:/(01)[0-9]{9}/',
            'address'=>'min:5|max:255',
            'date'=>'after:yesterday',
            'password'=>'max:50'
        ];
    }

     public function messages()
    {
        return [
            // 'name.alpha_dash' => 'Chỉ nhập các kí tự là: chữ, số, "-", "_"',
            'name.required' => 'Bạn chưa nhập <strong>Tên</strong>',
            'name.alpha' => 'Tên không được chứa số',
            'name.min' => 'Tên phải có từ 4 kí tự',
            'name.max' => 'Tên phải nhỏ hơn 32 kí tự',
            'phone.min' =>'Số điện thoại phải lớn hơn 10 ký tự',
            'phone.regex' =>'Số điện thoại bắt buộc là số',
            'address.min' =>'Địa chỉ không nhỏ hơn 5 ký tự',
            'address.max' =>'Địa chỉ không quá 255 ký tự',
            'date.after'  =>'Ngày sinh không bắt đầu từ hôm nay',
            'password.max' =>'Mật khẩu không quá 50 ký tự',
        ];
    }
}
