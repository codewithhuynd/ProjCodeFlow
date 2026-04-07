<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // 1. Hiển thị form tạo mật khẩu mới
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // 2. Xử lý lưu mật khẩu mới
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Đổi pass và lưu vào DB
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                // Đăng nhập luôn cho tiện
                Auth::login($user);
            }
        );

        // Chuyển hướng về trang chủ
        return $status === Password::PASSWORD_RESET
                    ? redirect('/home')->with('status', 'Đổi mật khẩu thành công!')
                    : back()->withErrors(['email' => ['Có lỗi xảy ra, token đã hết hạn hoặc không hợp lệ.']]);
    }
}