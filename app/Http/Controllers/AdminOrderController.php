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
        // ❌ Không cho sửa nếu đã hoàn thành / hủy
        if ($order->isFinal()) {
            return back()->with('error', 'Không thể cập nhật đơn này!');
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        $newStatus = $request->status;

        // 🔥 Check đúng flow
        if (!in_array($newStatus, Order::allowedNextStatuses($order->status))) {
            return back()->with('error', 'Sai luồng trạng thái!');
        }

        $order->update([
            'status' => $newStatus
        ]);

        return back()->with('success', 'Cập nhật thành công!');
    }
}
