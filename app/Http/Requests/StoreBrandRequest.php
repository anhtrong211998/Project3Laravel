<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'brand_name'    => 'required|min:2|max:255|unique:tbl_brand,brand_name,'.$this->brand_id.',brand_id',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 2 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
            'unique'   => ':attribute đã tồn tại',
        ];
    }
    public function attributes(){
        return [
            'brand_name'          => 'Tên nhãn hiệu',
        ];
    }
}
