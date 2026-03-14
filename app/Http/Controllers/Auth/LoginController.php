<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mở giao diện trang đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý khi bấm nút Đăng nhập
    public function login(Request $request)
    {
        // Nhận Email và Password người dùng nhập
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Kiểm tra xem có khớp với Database không
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Hợp lệ -> Chuyển về trang chủ (welcome)
            return redirect('/'); 
        }

        // Sai -> Quay lại báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }
}
