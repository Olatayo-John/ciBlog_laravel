<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'username' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'string'],
            'profileImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'password_change_notify' => ['nullable', 'boolean']
        ];
    }
}
