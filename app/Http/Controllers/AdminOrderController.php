<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->orderByDesc('id')
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->isFinal()) {
            return back()->with('error', 'Không thể cập nhật đơn này!');
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        $newStatus = $request->status;

        if (!in_array($newStatus, Order::allowedNextStatuses($order->status))) {
            return back()->with('error', 'Sai luồng trạng thái!');
        }

        if ($newStatus == 'canceled' || $newStatus == 'Đã hủy') {
            
            $order->load('items'); 
            
            foreach ($order->items as $item) {
                \App\Models\Product::where('id', $item->product_id)->increment('stock', $item->quantity);
            }
        }

        $order->update([
            'status' => $newStatus
        ]);

        return back()->with('success', 'Cập nhật trạng thái và xử lý kho thành công!');
    }
}