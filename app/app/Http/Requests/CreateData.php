<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateData extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:10',
                //         漢字     ひらがな    カタカナ    英数字    スペース    UTF-8
                'regex:/^[\p{Han}\p{Hiragana}\p{Katakana}a-zA-Z0-9    \s   ]+$  /u'
            ],
            'goods_name' => [
                'required',
                'string',
                'max:100',
                //         漢字     ひらがな    カタカナ    英数字    スペース    UTF-8
                'regex:/^[\p{Han}\p{Hiragana}\p{Katakana}a-zA-Z0-9    \s   ]+$  /u'
            ],
            'store_name' => [
                'required',
                'string',
                'max:20',
                //         漢字     ひらがな    カタカナ    英数字    スペース    UTF-8
                'regex:/^[\p{Han}\p{Hiragana}\p{Katakana}a-zA-Z0-9    \s   ]+$  /u'
            ],
            'email' => [
                'required',
                'email',
                'max:30'
            ],
            'password' => [
                'required',
                'confirmed',
                'max:100',
                Password::min(8)
                ->mixedCase()
            ],
            'quantity' => [
                'required',
                'regex:/^[1-9][0-9]*$/'
            ],
            'weight' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:today'
            ]
        ];
    }
}
