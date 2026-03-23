<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;

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

    public function manageProducts()
    {
    // Lấy toàn bộ sản phẩm từ Database, sắp xếp mới nhất lên đầu
    $products = Product::orderBy('id', 'desc')->get(); 
    
    // Trả về view và truyền biến $products sang
    return view('admin.products', compact('products'));
    }
    // 1. Hàm Xóa sản phẩm
    public function destroy($id) 
    {
    $product = Product::findOrFail($id);
    $product->delete(); // Xóa khỏi DB -> Trang chủ mất luôn sản phẩm này
    return redirect()->back()->with('success', 'Đã xóa sản phẩm!');
    }

// 2. Hàm hiện trang Sửa
    public function edit($id) 
    {
    $product = Product::findOrFail($id);
    return view('admin.edit_product', compact('product'));
    }

// 3. Hàm lưu dữ liệu sau khi Sửa
    public function update(Request $request, $id) 
    {
    $product = Product::findOrFail($id);
    
    // Cập nhật toàn bộ thông tin mới
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'image' => $request->image,
        'description' => $request->description, // Đã thêm dòng lưu mô tả
    ]);
    
    return redirect()->route('admin.products')->with('success', 'Cập nhật thành công!');
    }
    // Hàm Thêm sản phẩm mới
    public function store(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
            'description' => $request->description,
            'category_id' => 1, // Vì chưa làm chọn danh mục, gán tạm vào danh mục số 1
            'slug' => Str::slug($request->name), // Tự động tạo link slug từ tên sản phẩm
        ]);

        return redirect()->route('admin.products')->with('success', 'Đã thêm sản phẩm mới thành công!');
    }
}