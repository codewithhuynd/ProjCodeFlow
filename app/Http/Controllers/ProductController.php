<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
    // Thêm vào giỏ hàng (cộng dồn số lượng nếu đã có)
    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm giỏ hàng!']);
        }

        $userId = Auth::id();
        $quantity = $request->input('quantity', 1); // Lấy số lượng gửi lên, mặc định là 1

        // Kiểm tra xem sản phẩm đã có trong giỏ của user này chưa
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => $quantity
            ]);
        }

        $totalQuantity = Cart::where('user_id', $userId)->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng!',
            'cartCount' => $totalQuantity
        ]);
    }

    // Lấy dữ liệu giỏ hàng để hiển thị lên popup
    public function getCartDetails()
    {
        if (!Auth::check()) return response()->json([]);

        // Lấy danh sách giỏ hàng kèm thông tin sản phẩm
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return response()->json($carts);
    }

    // Cập nhật số lượng (+ / -) ngay trong popup
    public function updateCart(Request $request)
    {
        $cartId = $request->input('cart_id');
        $action = $request->input('action'); // 'increase' hoặc 'decrease'

        $cartItem = Cart::find($cartId);
        if ($cartItem) {
            if ($action == 'increase') {
                $cartItem->quantity += 1;
            } elseif ($action == 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            }
            $cartItem->save();
        }

        $totalQuantity = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['success' => true, 'cartCount' => $totalQuantity]);
    }
}