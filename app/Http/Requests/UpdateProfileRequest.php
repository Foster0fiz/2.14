<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Определяет, авторизован ли пользователь для выполнения этого запроса.
     */
    public function authorize()
    {
        // Используем фасад Auth вместо глобального хелпера auth()
        return Auth::check();
    }

    /**
     * Правила валидации для обновления профиля.
     */
    public function rules()
    {
        // Получаем ID текущего пользователя, чтобы исключить его email из проверки уникальности
        $userId = $this->user() ? $this->user()->id : null;

        return [
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $userId,
            'current_password'  => 'nullable|min:6',
            'password'          => 'nullable|min:6|confirmed',
            'avatar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
