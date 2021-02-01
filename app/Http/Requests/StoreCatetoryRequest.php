<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatetoryRequest extends FormRequest
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
            'catetory_name'    => 'required|min:2|max:255|unique:tbl_catetory,catetory_name,'.$this->catetory_id.',catetory_id',
            'catetory_desc'   => 'required|min:2|max:255',
            'category_catetory_id'   => 'required',
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
            'catetory_name'          => 'Tên loại sản phẩm',
            'catetory_desc'   => 'Mô tả',
            'category_catetory_id'=>'Danh mục sản phẩm'
        ];
    }
}
