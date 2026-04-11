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

        $reviews = $product->reviews()->with('user')->latest()->paginate(1);
        
        return view('product.detail', compact('product', 'reviews'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');

        if (empty($query)) {
            return redirect()->route('home');
        }

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

    public function getCartDetails()
    {
        if (!Auth::check()) return response()->json([]);
        return response()->json(Cart::with('product')->where('user_id', Auth::id())->get());
    }

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
    public function removeFromCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
        }

        $cartIds = $request->input('cart_ids');

        if (!empty($cartIds)) {
            Cart::where('user_id', Auth::id())
                ->whereIn('id', (array)$cartIds)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm thành công!',
                'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity')
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm để xóa.']);
    }
}