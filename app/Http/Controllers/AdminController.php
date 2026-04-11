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
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
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

    public function edit($id) 
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('products', 'public');
            $product->image = $path;
        } 
        elseif ($request->filled('image')) {
            $product->image = $request->image;
        }

        $product->save();
        
        return redirect()->route('admin.products')->with('success', 'Cập nhật thành công!');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->category_id = 1;
        $product->slug = Str::slug($request->name);

        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('products', 'public');
            $product->image = $path; 
        } 
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