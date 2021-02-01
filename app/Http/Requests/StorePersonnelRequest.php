<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelRequest extends FormRequest
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
            'personnel_name'    => 'required|min:2|max:255',
            'personnel_email'   => 'required|email|unique:tbl_personnel,personnel_email,'.$this->personnel_id.',personnel_id',
            'personnel_address' => 'required|min:2',
            'personnel_phone'   => 'required|numeric|unique:tbl_personnel,personnel_phone,'.$this->personnel_id.',personnel_id',
            'personnel_birth' => 'required',
            'personnel_position' => 'required',
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
            'personnel_name'    => 'Họ và tên',
            'personnel_email'   => 'Email',
            'personnel_address' => 'Địa chỉ',
            'personnel_phone'   => 'Số điện thoại',
            'personnel_birth' => 'Ngày sinh',
            'personnel_position' => 'Chức vụ',
            
        ];
    }
}
