<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Hàm hiển thị Form đổi mật khẩu
    public function changePasswordForm()
    {
        return view('auth.change_password');
    }

    // Hàm xử lý logic khi bấm nút "Đổi mật khẩu"
    public function updatePassword(Request $request)
    {
        // AC2 & AC3: Phải nhập đủ thông tin, mật khẩu mới tối thiểu 6 ký tự, có xác nhận và KHÔNG TRÙNG mật khẩu cũ
        $request->validate([
            'old_password' => 'required',
            // Thêm đuôi "|different:old_password" vào đây:
            'new_password' => 'required|min:6|confirmed|different:old_password', 
        ], [
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            // Thêm dòng thông báo lỗi bằng tiếng Việt này:
            'new_password.different' => 'Mật khẩu mới không được trùng với mật khẩu hiện tại.' 
        ]);

        // AC1 & AC4: Kiểm tra mật khẩu cũ. Nếu sai thì đá văng về kèm thông báo lỗi.
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác.']);
        }

        // Vượt qua hết kiểm tra thì tiến hành lưu mật khẩu mới vào Database
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // AC5: Đổi thành công thì yêu cầu đăng nhập lại (Xóa phiên đăng nhập cũ)
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Đẩy về trang login kèm thông báo thành công
        return redirect('/login')->with('success', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
    }
}