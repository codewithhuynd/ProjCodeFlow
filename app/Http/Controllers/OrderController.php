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
                ->where('user_id', Auth::id()) // Đồng bộ dùng Auth::id() cho chuẩn
                ->whereIn('id', $selectedIds)
                ->get();

            // KIỂM TRA TỒN KHO TRƯỚC KHI VÀO TRANG THANH TOÁN
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

    // XỬ LÝ ĐẶT HÀNG
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

        // KIỂM TRA TỒN KHO LẦN CUỐI TRƯỚC KHI TẠO ĐƠN
        foreach ($cartItems as $item) {
            if ($item->product->stock == 0) {
                return back()->with('error', 'Lỗi đặt hàng: Sản phẩm [' . $item->product->name . '] đã hết hàng!');
            } elseif ($item->quantity > $item->product->stock) {
                return back()->with('error', 'Lỗi đặt hàng: Sản phẩm [' . $item->product->name . '] chỉ còn ' . $item->product->stock . ' cái. Đơn hàng chưa được tạo!');
            }
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id(),
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
        $selectedIds = $request->selected;

        if ($selectedIds) {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->whereIn('id', $selectedIds)
                ->get();

            // KIỂM TRA KHO NGAY LÚC NÀY BẰNG AJAX
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
            ->where('user_id', Auth::id()) // 👉 ĐÃ SỬA LỖI auth()->id() THÀNH Auth::id()
            ->orderByDesc('id')
            ->get();

        return view('auth.orders', compact('orders'));
    }
    // XỬ LÝ HỦY ĐƠN HÀNG VÀ HOÀN TỒN KHO
    public function cancelOrder(Request $request, $id)
    {
        // Tìm đơn hàng của user hiện tại
        $order = Order::with('items.product')->where('id', $id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng!');
        }

        // Chỉ cho phép hủy nếu đơn hàng đang ở trạng thái 'pending' (chờ xác nhận / đang xử lý)
        // (Bạn nhớ sửa chữ 'pending' thành trạng thái tương ứng trong DB của bạn nhé, ví dụ 'Chờ xác nhận')
        if ($order->status == 'pending' || $order->status == 'Chờ xác nhận') {
            
            // 1. Hoàn trả lại số lượng cho từng sản phẩm vào kho
            foreach ($order->items as $item) {
                \App\Models\Product::where('id', $item->product_id)->increment('stock', $item->quantity);
            }

            // 2. Cập nhật trạng thái đơn hàng thành 'cancelled' (Đã hủy)
            $order->update(['status' => 'Đã hủy']);

            return back()->with('success', 'Đã hủy đơn hàng và hoàn trả số lượng vào kho thành công!');
        }

        return back()->with('error', 'Đơn hàng này không thể hủy được nữa!');
    }
}