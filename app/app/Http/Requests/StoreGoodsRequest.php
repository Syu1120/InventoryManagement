<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGoodsRequest extends FormRequest
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
            //
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.mixed' => 'パスワードには英大文字と小文字の両方を含めてください。',
            'password.numbers' => 'パスワードには数字を含めてください。',
            'password.symbols' => 'パスワードには記号を含めてください。',
            'password.letters' => 'パスワードには英字を含めてください。',
            'password.uncompromised' => 'このパスワードは過去に漏洩したことがあります。別のパスワードを使用してください。',
        ];
    }
}
