<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    public function showLogin() //Trả về giao diện đăng nhập admin
    {
        return view('admin.login');
    }

    public function login(Request $request) //Nhận dữ liệu từ form (email, password)
    {
        $credentials = $request->only('email','password'); //lấy đúng 2 trường email và passwor

        if(Auth::attempt($credentials)) //Laravel kiểm tra xem email + password có đúng trong database không
        {
            if(Auth::user()->is_admin) //nếu đúng trong database thì kiểm tra thêm điều kiện này nữa
            {
                return redirect('/admin/dashboard'); //rồi mới tới trang admin
            }

            Auth::logout(); //nếu sai thì gọi hàm logout được đ/n bên dưới và báo lỗi
            return back()->with('error','Bạn không phải admin');
        }

        return back()->with('error','Sai email hoặc mật khẩu'); //báo lỗi
    }


    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = DB::table('products')->count();
        $totalOrders = DB::table('orders')->count();
        $totalStock = DB::table('products')->sum('stock');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalStock'
        ));
    }

    public function logout()//Xóa thông tin đăng nhập khỏi session (giống như bộ nhớ tạm- để nhớ những gì người dùng nhập), sau đó quay về trang login
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}