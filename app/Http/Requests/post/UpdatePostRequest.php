<?php

namespace App\Http\Requests\post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'title' => 'required',
            'body' => 'required',
            'postImage' => 'array|nullable',
            'postImage.*' => ['image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }

    public function message()
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required'
        ];
    }
}
