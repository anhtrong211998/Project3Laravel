<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'contact_name'    => 'required|min:2|max:255|',
            'contact_email'   => 'required|email',
            'contact_content' => 'required|min:2',
            'contact_phone'   => 'required|numeric',
            'contact_address' => 'required',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 2 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
            'email'    => ':attribute nhập email của bạn',
            'numeric'  => ':attribute nhập số điện thoại',
        ];
    }
    public function attributes(){
        return [
            'contact_name'    => 'Họ và tên',
            'contact_email'   => 'Email',
            'contact_content' => 'Nội dung',
            'contact_phone'   => 'Số điện thoại',
            'contact_address' => 'Địa chỉ',
        ];
    }

}
