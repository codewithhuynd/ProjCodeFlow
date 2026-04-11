<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function changePasswordForm()
    {
        return view('auth.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed|different:old_password', 
        ], [
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.different' => 'Mật khẩu mới không được trùng với mật khẩu hiện tại.' 
        ]);

        if (!Hash::check($request->old_password, $request->user()->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác.']);
        }

        $request->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại!');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $request->user()->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => 'ảnh đại diện mặc định.jpg'
        ]);

        return back()->with('success', 'Đã lưu lại thông tin thành công!');
    }
}