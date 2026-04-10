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
            return back()->with('error', 'Không thể cập nhật trạng thái cho đơn đã hoàn thành/đã hủy.');
        }

        $validated = $request->validate([
            'status' => ['required', 'string'],
        ]);

        $newStatus = $validated['status'];
        $allowed = Order::allowedNextStatuses($order->status);

        if (!in_array($newStatus, $allowed, true)) {
            return back()->with('error', 'Trạng thái không hợp lệ theo luồng chuẩn.');
        }

        $order->status = $newStatus;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}

