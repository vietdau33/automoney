<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'regex:/^[A-Za-z\d\.\_\-]{4,}$/i', 'unique:users,username'],
            'fullname' => 'required',
            'phone' => ['required', 'regex:/^\d{8,11}$/i', 'unique:user_info,phone'],
            'email' => 'required|email:rfc|unique:users,email',
            'password' => 'required|confirmed|string|min:5',
            'password_confirmation' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'username has required',
            'username.regex' => 'Username can only contain lowercase, uppercase, numbers, dot, strikethrough, underlined and 4 or more characters',
            'username.unique' => 'Username available',
            'fullname.required' => 'First and last name cannot be blank',
            'phone.required' => 'Phone number is empty',
            'phone.regex' => 'invalid phone number',
            'phone.unique' => 'Phone number already in use',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Email address is not valid',
            'email.unique' => 'The email address has been used',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Password does not match',
            'password.min' => 'Password must be at least 5 characters',
            'password_confirmation.required' => 'Please re-enter password to confirm'
        ];
    }
}
