<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name'    => 'required|min:10|max:255',
            'product_desc'   => 'required|min:10',
            'product_content' => 'required|min:10',
            'product_quantity'   => 'required|numeric',
            'product_price' => 'required|numeric',
            'product_sale' => 'required|numeric',
            'catetory_product_id' => 'required',
            'brand_product_id' => 'required',
            'provider_product_id' => 'required',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 10 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
            'numeric' => ':attribute phải là số'
        ];
    }
    public function attributes(){
        return [
            'product_name'    => 'Tên sản phẩm',
            'product_desc'   => 'Mô tả',
            'product_content' => 'Nội dung',
            'product_quantity'   => 'Số lượng',
            'product_price' => 'Giá bán',
            'product_sale' => 'Giảm giá',
            'catetory_product_id' => 'Loại sản phẩm',
            'brand_product_id' => 'Nhãn hiệu',
            'provider_product_id' => 'Nhà cung cấp',
        ];
    }
}
