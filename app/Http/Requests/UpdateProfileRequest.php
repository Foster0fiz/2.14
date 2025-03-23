<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check(); // Allow only authenticated users
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable|min:6',
            'password' => 'nullable|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'email.email' => 'Invalid email format!',
            'email.unique' => 'This email is already taken!',
            'current_password.min' => 'Current password must be at least 6 characters!',
            'password.min' => 'New password must be at least 6 characters!',
            'password.confirmed' => 'New password confirmation does not match!',
            'avatar.image' => 'The avatar must be an image!',
            'avatar.mimes' => 'The avatar must be in jpeg, png, jpg, or gif format!',
            'avatar.max' => 'The avatar size must not exceed 2MB!',
        ];
    }
}
