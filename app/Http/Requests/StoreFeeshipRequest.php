<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeshipRequest extends FormRequest
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
            'fee_matp'    => 'required',
            'fee_maquanhuyen'   => 'required',
            'fee_maxaphuong' => 'required',
            'fee_ship'   => 'required|numeric',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'numeric'  => ':attribute phải là số',
        ];
    }
    public function attributes(){
        return [
            'fee_matp'    => 'Tỉnh/Thành phố',
            'fee_maquanhuyen'   => 'Quận/Huyện',
            'fee_maxaphuong' => 'Xã/Phường/Thị trấn',
            'fee_ship'   => 'Tiền vận chuyển',
        ];
    }
}
