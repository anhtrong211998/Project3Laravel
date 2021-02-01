<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'name'   =>  'required|min:10|max:255',
            'email'  =>  'required|email|unique:users,email,'.$this->id.',id',
            'phone'  =>  'required|numeric|unique:users,phone,'.$this->id.',id',
        ];
    }
    public function messages(){
        return [
            'required'  => ':attribute không được để trống',
            'min'       => ':attribute phải nhập ít nhất 10 ký tự',
            'max'       => ':attribute nhập tối đa 255 ký tự',
            'unique'    => ':attribute đã tồn tại',
            'numeric'   => ':attribute phải là số',
        ];
    }
    public function attributes(){
        return [
            'name'    => 'Họ và tên',
            'email'   => 'email',
            'phone'   => 'Số điện thoại',
        ];
    }
}
