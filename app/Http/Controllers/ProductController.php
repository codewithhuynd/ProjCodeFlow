<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // --- CÁC HÀM DÀNH CHO KHÁCH HÀNG (FRONT-END) ---

    // 1. Xem chi tiết 1 sản phẩm
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Lấy danh sách đánh giá của sản phẩm này, phân trang mỗi trang 5 cái
        // latest() để đưa đánh giá mới nhất lên đầu
        $reviews = $product->reviews()->with('user')->latest()->paginate(1);
        
        return view('product.detail', compact('product', 'reviews'));
    }

    // 2. Tìm kiếm và lọc sản phẩm ở trang chủ
    public function search(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');

        if (empty($query)) {
            return redirect()->route('home');
        }

        // Đã nâng cấp: Tính trung bình sao và đếm số lượng đánh giá ngay lúc tìm kiếm
        $productsQuery = Product::withAvg('reviews', 'rating')
                                ->withCount('reviews')
                                ->where(function ($q) use ($query) {
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

    // --- CÁC HÀM XỬ LÝ GIỎ HÀNG ---

    // 3. Thêm sản phẩm vào giỏ
    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
        }
        $userId = Auth::id();
        $quantity = $request->input('quantity', 1);
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId, 'product_id' => $id, 'quantity' => $quantity
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Đã thêm!', 'cartCount' => Cart::where('user_id', $userId)->sum('quantity')]);
    }

    // 4. Lấy dữ liệu giỏ hàng hiển thị lên Popup
    public function getCartDetails()
    {
        if (!Auth::check()) return response()->json([]);
        return response()->json(Cart::with('product')->where('user_id', Auth::id())->get());
    }

    // 5. Cập nhật số lượng (+ / -) trong giỏ hàng
    public function updateCart(Request $request)
    {
        $cartItem = Cart::find($request->cart_id);
        if ($cartItem) {
            if ($request->action == 'increase') $cartItem->quantity += 1;
            elseif ($request->action == 'decrease' && $cartItem->quantity > 1) $cartItem->quantity -= 1;
            $cartItem->save();
        }
        return response()->json(['success' => true, 'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity')]);
    }
}