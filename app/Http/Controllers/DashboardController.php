<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Получаем авторизованного пользователя (предполагаем, что маршрут защищён middleware)
        $user = Auth::user();
        return view('dashboard', ['user' => $user]);
    }
}
