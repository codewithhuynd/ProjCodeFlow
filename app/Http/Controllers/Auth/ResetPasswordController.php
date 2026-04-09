<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResetPasswordController extends Controller
{
    // 1. Hiển thị form tạo mật khẩu mới
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // 2. Xử lý lưu mật khẩu bằng tay (Kiểm soát 100% lỗi)
    public function reset(Request $request)
    {
        // Bước A: Kiểm tra dữ liệu người dùng gõ
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Bước B: Tìm tài khoản
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'LỖI 1: Không tìm thấy tài khoản với email này.']);
        }

        // Bước C: Tìm và đối chiếu Token trong Database
        $tokenRecord = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$tokenRecord || !Hash::check($request->token, $tokenRecord->token)) {
            return back()->withErrors(['email' => 'LỖI 2: Link đổi mật khẩu đã quá hạn hoặc không hợp lệ. Vui lòng tạo link mới.']);
        }

        // Bước D: MỌI THỨ HOÀN HẢO -> Lưu mật khẩu (Giống hệt cách bạn làm bài Test)
        $user->password = $request->password; 
        $user->save();

        // Bước E: Dọn dẹp token cũ để không bị dùng lại
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Bước F: Đăng nhập luôn và dẫn về trang chủ
        Auth::login($user);
        
        return redirect('/home'); // Nếu trang chủ của bạn là trang khác, hãy đổi '/home' thành '/'
    }
}