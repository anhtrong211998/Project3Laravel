<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'article_name'    => 'required|min:10|max:255|unique:tbl_article,article_name,'.$this->article_id.',article_id',
            'article_description'   => 'required|min:10|max:255',
            'article_content' => 'required|min:10',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'min'      => ':attribute phải nhập ít nhất 10 ký tự',
            'max'      => ':attribute nhập tối đa 255 ký tự',
        ];
    }
    public function attributes(){
        return [
            'article_name'          => 'Tên tin tức',
            'article_description'   => 'Mô tả',
            'article_content'       => 'Nội dung',
        ];
    }
}
