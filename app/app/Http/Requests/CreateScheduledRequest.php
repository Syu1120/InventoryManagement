<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateScheduledRequest extends FormRequest
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
            'goods_id' => [
                'required',
                Rule::exists('goods', 'id')->whereNull('deleted_at'),
            ],
            'quantity' => [
                'required',
                'regex:/^[1-9][0-9]*$/'
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:today'
            ]
        ];
    }
}
