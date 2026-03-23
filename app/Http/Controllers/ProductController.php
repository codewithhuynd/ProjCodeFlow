<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.detail', compact('product'));
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Nếu người dùng không nhập gì mà bấm tìm kiếm thì trả về trang chủ (chống lỗi)
    if (empty($query)) {
        return redirect()->route('home'); // Hoặc trả về redirect()->back();
    }

    $products = Product::where(function ($q) use ($query) {
        $q->where('name', 'LIKE', $query . ' %')          
          ->orWhere('name', 'LIKE', '% ' . $query . ' %') 
          ->orWhere('name', 'LIKE', '% ' . $query)
          ->orWhere('name', '=', $query);
    })
    // // Tương tự cho phần mô tả (nếu muốn tìm cả trong description)
    // ->orWhere(function ($q) use ($query) {
    //     $q->where('description', 'LIKE', $query . ' %')
    //       ->orWhere('description', 'LIKE', '% ' . $query . ' %')
    //       ->orWhere('description', 'LIKE', '% ' . $query)
    //       ->orWhere('description', '=', $query);
    // })
    ->get();

    return view('auth.home', compact('products'));
}
}