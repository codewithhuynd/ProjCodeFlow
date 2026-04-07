<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // 1. Hiển thị form nhập email
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // 2. Xử lý gửi mail chứa link reset
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Gọi chức năng gửi mail của Laravel
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Trả về thông báo thành công hoặc lỗi
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'Link đặt lại mật khẩu đã được gửi vào email của bạn!'])
                    : back()->withErrors(['email' => 'Không tìm thấy tài khoản với email này.']);
    }
}