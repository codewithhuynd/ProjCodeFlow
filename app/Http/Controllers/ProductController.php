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
    $sort = $request->input('sort');

    // Nếu người dùng không nhập gì mà bấm tìm kiếm thì trả về trang chủ (chống lỗi)
    if (empty($query)) {
        return redirect()->route('home'); // Hoặc trả về redirect()->back();
    }

    $productsQuery = Product::where(function ($q) use ($query) {
        $q->where('name', 'LIKE', $query . ' %')          
          ->orWhere('name', 'LIKE', '% ' . $query . ' %') 
          ->orWhere('name', 'LIKE', '% ' . $query)
          ->orWhere('name', '=', $query);
    });
    if ($sort == 'price_asc'){
        $productsQuery->orderBy('price', 'asc');
    } elseif ($sort == 'price_desc'){
        $productsQuery->orderBy('price', 'desc');
    }
    $products = $productsQuery->get();

    return view('auth.home', compact('products'));
}
    public function addToCart($id)
    {
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$id])) {
            return response()->json([
                'success' => false, // Gửi về false để JS biết là không thành công
                'alreadyInCart' => true,
                'message' => 'Sản phẩm này đã được thêm vào giỏ hàng trước đó!'
            ]);
        }

        // Nếu chưa có thì mới lấy thông tin sản phẩm và thêm vào
        $product = Product::findOrFail($id);
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
            "quantity" => 1 // Mặc định là 1 và không tăng thêm ở các lần bấm sau
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Thêm vào giỏ hàng thành công!',
            'cartCount' => array_sum(array_column($cart, 'quantity'))
        ]);
    }
}