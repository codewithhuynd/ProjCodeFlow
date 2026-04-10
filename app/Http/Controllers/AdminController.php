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
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)) 
        {
            if(Auth::user()->is_admin) 
            {
                return redirect('/admin/dashboard'); 
            }

            Auth::logout(); 
            return back()->with('error','Bạn không phải admin');
        }

        return back()->with('error','Sai email hoặc mật khẩu'); 
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

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function manageProducts(Request $request)
    {
        $query = Product::query();

        // Xử lý bộ lọc trạng thái tồn kho
        if ($request->has('stock_status')) {
            if ($request->stock_status == 'in_stock') {
                $query->where('stock', '>=', 10);
            } elseif ($request->stock_status == 'low_stock') {
                $query->where('stock', '>', 0)->where('stock', '<', 10);
            } elseif ($request->stock_status == 'out_of_stock') {
                $query->where('stock', '=', 0);
            }
        }
        // Lấy toàn bộ sản phẩm từ Database, sắp xếp mới nhất lên đầu
        $products = $query->orderBy('id', 'desc')->get(); 
        
        return view('admin.products', compact('products'));
    }

    // 1. Hàm Xóa sản phẩm
    public function destroy($id) 
    {
        $product = Product::findOrFail($id);
        $product->delete(); 
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
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock; // Thêm dòng này để cập nhật Tồn kho
        $product->description = $request->description;

        // Ưu tiên 1: Cập nhật file ảnh từ máy
        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('products', 'public');
            $product->image = $path;
        } 
        // Ưu tiên 2: Cập nhật URL ảnh mới
        elseif ($request->filled('image')) {
            $product->image = $request->image;
        }

        $product->save();
        
        return redirect()->route('admin.products')->with('success', 'Cập nhật thành công!');
    }

    // 4. Hàm Thêm sản phẩm mới
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->category_id = 1; // Vì chưa làm chọn danh mục, gán tạm vào danh mục số 1
        $product->slug = Str::slug($request->name); // Tự động tạo link slug từ tên sản phẩm

        // Ưu tiên 1: Tải file từ máy
        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('products', 'public');
            $product->image = $path; 
        } 
        // Ưu tiên 2: Nhập URL
        elseif ($request->filled('image')) {
            $product->image = $request->image;
        } 
        // Dự phòng
        else {
            $product->image = 'https://via.placeholder.com/150';
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Đã thêm sản phẩm mới thành công!');
    }
}