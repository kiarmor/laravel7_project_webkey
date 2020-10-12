<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveOrderRequest extends FormRequest
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
            'user_name' => 'required|min:3|max:100|string',
            'phone_number' => 'min:3|max:15',
            'email' => [
                'email',
                'max:100',
            ],
            'address' => 'required|min:3|max:300|string',

        ];
    }
}
