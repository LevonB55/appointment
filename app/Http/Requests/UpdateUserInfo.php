<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfo extends FormRequest
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
            'fname'     => 'sometimes|required|string|min:2|max:255',
            'mname'     => 'nullable|string|min:2|max:255',
            'lname'     => 'sometimes|required|string|min:2|max:255',
            'phone'     => 'nullable|string|min:4|max:255',
            'gender'    => 'sometimes|required|string',
            'birthday'  => 'sometimes|required|string',
            'user_type' => 'sometimes|required|string',
            'profession' => 'nullable|string|max:100',
            'experience' => 'nullable|numeric|min:0|max:100',
            'background' => 'nullable|string|max:700',
            'avatar'     => 'nullable|image'
        ];
    }
}
