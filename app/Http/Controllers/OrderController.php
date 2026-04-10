<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 🔹 Trang checkout (Chỉ nhận dữ liệu từ Giỏ hàng)
    public function checkout(Request $request)
    {
        $selectedIds = session('selected_cart_ids');

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', $request->user()->id)
                ->whereIn('id', $selectedIds)
                ->get();
        } else {
            return back()->with('error', 'Bạn chưa chọn sản phẩm nào từ giỏ hàng!');
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

        $selectedIds = session('selected_cart_ids');

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', $request->user()->id)
                ->whereIn('id', $selectedIds)
                ->get();
        } else {
            return back()->with('error', 'Bạn chưa chọn sản phẩm!');
        }

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        // Lưu chi tiết đơn hàng & Trừ tồn kho tự động
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);

            // Trừ kho ngay lập tức
            \App\Models\Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
        }

        // Xóa sản phẩm đã mua khỏi giỏ hàng
        Cart::whereIn('id', $selectedIds)->delete();

        // Xóa session
        session()->forget('selected_cart_ids');

        return redirect('/home')->with('success', 'Đặt hàng thành công!');
    }

    // 🔹 Xử lý lưu các sản phẩm được tick chọn trong giỏ hàng để chuyển sang trang Checkout
    public function checkoutSelected(Request $request)
    {
        session([
            'selected_cart_ids' => $request->selected
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}