<?php

namespace App\Http\Requests\comment;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentRequest extends FormRequest
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
            'post_id' => 'required|integer',
            'comment' => 'required'
        ];
    }

    public function message(): array
    {
        return [
            'comment' => 'comment field is required'
        ];
    }
}
