<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $currentDay = date('d-m-Y',strtotime("+1 day"));
        return [
            //
        	'name' =>'min:6|max:100',
            'address' => 'min:3|max:100',
            'phone'=>'numeric|digits_between:9, 11',
            'image' => 'mimes:jpeg,jpg,png|max:1000',
            'date_of_birth' =>'date|before:'.$currentDay,
        ];
    }

    public function messages()
    {
        return [
        'name.max' => 'Tên không quá 100 kí tự',
        'name.min' => 'Tên không nhỏ hơn 6 kí tự',
        'address.min' => 'Địa chỉ không nhỏ hơn 3 kí tự',
        'address.max' => 'Địa chỉ không lớn hơn 200 kí tự',
        'phone.digits_between' => 'Nhập đúng định dạng số điện thoại',
        'date_of_birth.date' =>'Nhập đúng định dạng ngày sinh của bạn',
        'image.mimes' => 'Tệp chưa đúng định dạng',
        'image.max' => 'Chọn tệp có có dung lượng nhỏ hơn ',
        'date_of_birth.before' =>'Ngày sinh trước ngày hôm nay',
        ];
    }
}