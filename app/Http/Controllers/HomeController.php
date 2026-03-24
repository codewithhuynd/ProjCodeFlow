<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Tạo query builder
        $products = Product::query();

        // Kiểm tra tham số sort từ URL
        if ($request->sort == 'price_asc') {
            // Giá thấp -> cao
            $products->orderBy('price', 'asc');
        } 
        elseif ($request->sort == 'price_desc') {
            // Giá cao -> thấp
            $products->orderBy('price', 'desc');
        } 
        else {
            // Mặc định: sản phẩm mới nhất
            $products->latest();
        }

        // Lấy dữ liệu
        $products = $products->get();

        // Trả về view trang chủ
        return view('auth.home', compact('products'));
    }
}