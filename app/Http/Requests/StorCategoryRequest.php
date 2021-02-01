<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorCategoryRequest extends FormRequest
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
            'category_name'    => 'required|min:2|max:255|unique:tbl_category,category_name,'.$this->category_id.',category_id',
            'category_desc'   => 'required|min:2|max:255',
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
            'category_name'          => 'Tên danh mục',
            'category_desc'   => 'Mô tả',
        ];
    }
}
