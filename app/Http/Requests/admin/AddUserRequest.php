<?php

namespace App\Http\Requests\admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users','email')],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'string'],
            'profileImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'role' => ['required', 'string'],
        ];
    }
}
