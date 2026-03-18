<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Gọi Model Product ra làm việc

class HomeController extends Controller
{
    public function index()
    {
        // AC1 & AC2: Lấy danh sách sản phẩm và tự động sắp xếp mới nhất (created_at giảm dần)
        // Dùng take(8) để giới hạn lấy 8 sản phẩm hiển thị cho đẹp
        $products = Product::latest()->take(8)->get();

        // Truyền biến $products ra ngoài giao diện
        return view('auth.home', compact('products'));
    }
}