<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    // Hiển thị form cập nhật thông tin
    public function edit()
    {
        $user = Auth::user();
        return view('auth.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validate dữ liệu (Đã bỏ validate avatar)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // 2. Cập nhật các thông tin cơ bản
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        
        // Cố định tên file ảnh mặc định trong DB (nếu muốn)
        $user->avatar = 'ảnh đại diện mặc định.jpg';

        // 3. Lưu vào cơ sở dữ liệu
        $user->save();

        // 4. Quay lại và hiển thị thông báo thành công
        return back()->with('success', 'Đã lưu lại thông tin thành công!');
    }
}