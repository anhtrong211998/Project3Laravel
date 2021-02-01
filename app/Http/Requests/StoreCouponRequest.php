<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'coupon_name'    => 'required|min:2|max:255',
            'coupon_code'   => 'required|min:2|max:255|unique:tbl_coupon,coupon_code,'.$this->coupon_id.',coupon_id',
            'coupon_time' => 'required|numeric',
            'coupon_number'   => 'required|numeric',
            'coupon_condition' => 'required',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 2 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
            'unique'   => ':attribute đã tồn tại',
            'numeric'  => ':attribute phải là số',
        ];
    }
    public function attributes(){
        return [
            'coupon_name'    => 'Tên sự kiện',
            'coupon_code'   => 'Mã giảm giá',
            'coupon_time' => 'Số lượng phiếu',
            'coupon_number'   => 'Giá trị giảm',
            'coupon_condition' => 'Tính năng mã'
        ];
    }
}
