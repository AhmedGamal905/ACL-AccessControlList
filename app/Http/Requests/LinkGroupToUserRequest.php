<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkGroupToUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group_id' => ['required', 'exists:groups,id'],
        ];
    }

    /**
     * Get custom error messages for validator.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'group_id.required' => 'Please select a group.',
            'group_id.exists' => 'The selected group does not exist.',
        ];
    }
}
