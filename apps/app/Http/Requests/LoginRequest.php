<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required|string|min:5'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'enter username',
            'password.required' => 'Please enter password',
            'password.min' => 'Password must be at least 5 characters',
        ];
    }
}
