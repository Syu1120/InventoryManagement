<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateData extends FormRequest
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
                //           漢字     ひらがな    カタカナ        英数字    スペース      UTF-8
                // 'regex:/^[\p{Han}\p{Hiragana}\p{Katakana}  a-zA-Z0-9    \s     ]+$  /u'
            'name' => [
                'required',
                'string',
                'max:10',
            ],
            'goods_id' => [
                'required',
                Rule::exists('goods', 'id')->whereNull('deleted_at'),
            ],
            'goods_name' => [
                'required',
                'string',
                'max:100',
            ],
            'store_name' => [
                'required',
                'string',
                'max:20',
            ],
            'email' => [
                'required',
                'email',
                'max:30'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'max:100',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
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
