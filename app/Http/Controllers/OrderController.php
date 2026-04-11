<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $selectedIds = session('selected_cart_ids');

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->whereIn('id', $selectedIds)
                ->get();

            foreach ($cartItems as $item) {
                if ($item->product->stock == 0) {
                    return redirect('/home')->with('error', 'Sản phẩm [' . $item->product->name . '] đã hết hàng!');
                } elseif ($item->quantity > $item->product->stock) {
                    return redirect('/home')->with('error', 'Sản phẩm [' . $item->product->name . '] chỉ còn ' . $item->product->stock . ' cái. Vui lòng giảm số lượng!');
                }
            }

        } else {
            return back()->with('error', 'Bạn chưa chọn sản phẩm nào từ giỏ hàng!');
        }

        return view('checkout', compact('cartItems'));
    }

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
                ->where('user_id', Auth::id())
                ->whereIn('id', $selectedIds)
                ->get();
        } else {
            return back()->with('error', 'Bạn chưa chọn sản phẩm!');
        }

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Giỏ hàng trống!');
        }

        foreach ($cartItems as $item) {
            if ($item->product->stock == 0) {
                return back()->with('error', 'Lỗi đặt hàng: Sản phẩm [' . $item->product->name . '] đã hết hàng!');
            } elseif ($item->quantity > $item->product->stock) {
                return back()->with('error', 'Lỗi đặt hàng: Sản phẩm [' . $item->product->name . '] chỉ còn ' . $item->product->stock . ' cái. Đơn hàng chưa được tạo!');
            }
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
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

            \App\Models\Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
        }

        Cart::whereIn('id', $selectedIds)->delete();

        session()->forget('selected_cart_ids');

        return redirect('/home')->with('success', 'Đặt hàng thành công!');
    }

    public function checkoutSelected(Request $request)
    {
        $selectedIds = $request->selected;

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->whereIn('id', $selectedIds)
                ->get();

            foreach ($cartItems as $item) {
                if ($item->product->stock == 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sản phẩm [' . $item->product->name . '] đã hết hàng!'
                    ]);
                } elseif ($item->quantity > $item->product->stock) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sản phẩm [' . $item->product->name . '] chỉ còn ' . $item->product->stock . ' cái. Vui lòng giảm số lượng!'
                    ]);
                }
            }
        }

        session([
            'selected_cart_ids' => $selectedIds
        ]);

        return response()->json([
            'success' => true
        ]);
    }
    // 🔹 Lịch sử đơn hàng của tôi
    public function myOrders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('auth.orders', compact('orders'));
    }
    public function cancelOrder(Request $request, $id)
    {
        $order = Order::with('items.product')->where('id', $id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng!');
        }

        if ($order->status == 'pending' || $order->status == 'Chờ xác nhận') {
            
            foreach ($order->items as $item) {
                \App\Models\Product::where('id', $item->product_id)->increment('stock', $item->quantity);
            }

            $order->update(['status' => 'Đã hủy']);

            return back()->with('success', 'Đã hủy đơn hàng và hoàn trả số lượng vào kho thành công!');
        }

        return back()->with('error', 'Đơn hàng này không thể hủy được nữa!');
    }
}