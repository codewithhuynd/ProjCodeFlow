<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 🔹 Trang checkout
    public function checkout()
    {
        // 👉 Nếu mua ngay
        if (session()->has('buy_now')) {
            $item = session('buy_now');

            $cartItems = collect([
                (object)[
                    'product' => (object)[
                        'name' => $item['name'],
                        'price' => $item['price']
                    ],
                    'quantity' => $item['quantity']
                ]
            ]);

            return view('checkout', compact('cartItems'));
        }

        // 👉 Nếu từ cart
        $selectedIds = session('selected_cart_ids');

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->whereIn('id', $selectedIds)
                ->get();
        } else {
            return back()->with('error', 'Bạn chưa chọn sản phẩm!');
        }

        return view('checkout', compact('cartItems'));
    }
    // 🔥 XỬ LÝ ĐẶT HÀNG
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // 🔥 TRƯỜNG HỢP MUA NGAY
        if (session()->has('buy_now')) {

            $item = session('buy_now');

            $total = $item['price'] * $item['quantity'];

            $order = Order::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $total,
                'status' => 'pending'
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            session()->forget('buy_now');

            return redirect('/home')->with('success', 'Đặt hàng thành công!');
        }

        // 🔥 TRƯỜNG HỢP CART
        $selectedIds = session('selected_cart_ids');

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->whereIn('id', $selectedIds)
                ->get();
        } else {
            return back()->with('error', 'Bạn chưa chọn sản phẩm!');
        }

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Giỏ hàng trống!');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        Cart::whereIn('id', $selectedIds)->delete();

        return redirect('/home')->with('success', 'Đặt hàng thành công!');
    }



    public function buyNow(Request $request)
    {
        $product = \App\Models\Product::findOrFail($request->product_id);

        session([
            'buy_now' => [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity
            ]
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function checkoutSelected(Request $request)
    {
        session()->forget('buy_now'); // ❗ QUAN TRỌNG

        session([
            'selected_cart_ids' => $request->selected
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
