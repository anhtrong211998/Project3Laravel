<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'customer_name'    => 'required|min:2|max:255|unique:tbl_customers,customer_name,'.$this->customer_id.',customer_id',
            'customer_email'   => 'required|email|unique:tbl_customers,customer_email,'.$this->customer_id.',customer_id',
            'customer_address' => 'required|min:2|unique:tbl_customers,customer_address,'.$this->customer_id.',customer_id',
            'customer_phone'   => 'required|numeric|unique:tbl_customers,customer_phone,'.$this->customer_id.',customer_id',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 2 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
            'email'    => ':attribute nhập email của bạn',
            'numeric'  => ':attribute phải là số',
            'unique'   => ':attribute đã tồn tại',
        ];
    }
    public function attributes(){
        return [
            'customer_name'    => 'Họ và tên',
            'customer_email'   => 'Email',
            'customer_address' => 'Địa chỉ',
            'customer_phone'   => 'Số điện thoại',
            
        ];
    }
}
