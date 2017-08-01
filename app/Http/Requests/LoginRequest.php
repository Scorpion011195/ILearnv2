<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name'=> 'required|min:6|max:32|alpha_dash',
            'pass'=> 'required|min:6|max:100',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'Trường username là bắt buộc',
            'name.required' => 'Trường username là bắt buộc',
            'name.min' => 'Tên đăng nhập lớn hơn 6 kí tự',
            'name.max' =>'Tên đăng nhập nhỏ hơn 6 kí tự',
            'name.alpha_dash' => 'Chỉ nhập các kí tự là: chữ, số, "-", "_"',
            'pass.required' => 'Mật khẩu là bắt buộc',
            'pass.min' => 'Mật khẩu lớn hơn 6 kí tự',
            'pass.max' => 'Mật khẩu nhỏ hơn 100 kí tự',
        ];
    }
}
