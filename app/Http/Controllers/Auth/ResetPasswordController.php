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
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'LỖI 1: Không tìm thấy tài khoản với email này.']);
        }

        $tokenRecord = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$tokenRecord || !Hash::check($request->token, $tokenRecord->token)) {
            return back()->withErrors(['email' => 'LỖI 2: Link đổi mật khẩu đã quá hạn hoặc không hợp lệ. Vui lòng tạo link mới.']);
        }

        $user->password = $request->password; 
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        Auth::login($user);
        
        return redirect('/home');
    }
}