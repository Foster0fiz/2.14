<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
{
    $user = Auth::user();
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'current_password' => 'nullable|min:6',
        'password' => 'nullable|min:6|confirmed',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Parolni o'zgartirish
    if (!empty($data['password'])) {
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        $user->password = Hash::make($data['password']);
    }

    // Avatarni yuklash
    if ($request->hasFile('avatar')) {
        // Удаляем старый аватар, если он есть
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }
        
        // Загружаем новый аватар в storage/app/public/avatars
        $user->avatar = $request->file('avatar')->store('avatars', 'public');
    }
    

    $user = Auth::user(); // Загружаем текущего пользователя



$user->name = $data['name'];
$user->email = $data['email'];

$user->save();



    // ✅ Foydalanuvchini dashboard sahifasiga yo‘naltirish
    return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
}

}
