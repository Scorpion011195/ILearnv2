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
        	'name' =>'required',
            'phone'=>'required|numeric|digits_between:9, 11',
            'image' => 'mimes:jpeg,jpg,png|max:1000',
            'date_of_birth' =>'date|before:'.$currentDay,
        ];
    }

    public function messages()
    {
        return [
        'name.required' => 'Bạn chưa nhập thông tin vào trường này',
        'phone.required' => 'Bạn chưa nhập thông tin vào trường này',
        'phone.digits_between' => 'Nhập đúng định dạng số điện thoại',
        'date_of_birth.date' =>'Nhập đúng định dạng ngày sinh của bạn',
        'image.mines' => 'Tệp chưa đúng định dạng',
        'date_of_birth.before' =>'Ngày sinh trước ngày hôm nay',
        ];
    }
}