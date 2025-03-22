<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' проверяет соответствие
        ]);
    }
    public function register(RegisterRequest $request)
{
    $data = $request->validated();

    // Проверяем, загружен ли аватар
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public'); // Сохраняем в storage/app/public/avatars
        $data['avatar'] = $avatarPath;
    }

    $data['password'] = Hash::make($data['password']);

    $user = User::create($data);

    Auth::login($user);

    return redirect()->route('dashboard')->with('success', 'Registration successful!');
}

}
