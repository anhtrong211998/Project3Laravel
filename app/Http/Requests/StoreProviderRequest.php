<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            'provider_name'    => 'required|min:2|max:255',
            'provider_address'   => 'required|min:2|max:255',
            'provider_email'   => 'required|min:2|max:255|email',
            'provider_phone'   => 'required|numeric',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 2 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
            'email'    => ':attribute không đúng định dạng',
            'numeric'  => ':attribute nhập số điện thoại',
            // 'unique'   => ':attribute đã tồn tại',
        ];
    }
    public function attributes(){
        return [
            'provider_name'          => 'Tên nhà cung cấp',
            'provider_address'   => 'Địa chỉ',
            'provider_email'   => 'Email',
            'provider_phone'   => 'Số điện thoại',
        ];
    }
}
