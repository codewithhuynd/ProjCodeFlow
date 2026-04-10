<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // 1. Hiển thị form đánh giá
    public function create($id)
    {
        // Lấy đơn hàng (Phải đúng của user đó)
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        // Trạng thái trong DB của bạn lưu là 'completed'
        if ($order->status != 'completed') {
            return redirect('/my-orders')->with('error', 'Chỉ được đánh giá khi đơn hàng đã hoàn thành!');
        }

        // Kiểm tra xem đã đánh giá chưa để tránh spam
        $review = Review::where('order_id', $id)->first();

        // NẾU CÓ RỒI: Mở giao diện XEM LẠI đánh giá
        if ($review) {
            return view('review.show', compact('order', 'review'));
        }

        // NẾU CHƯA CÓ: Mở giao diện FORM ĐÁNH GIÁ mới
        return view('review.create', compact('order'));
    }
    // 2. Lưu đánh giá vào Database
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|min:5'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        // Đánh giá xong đẩy về trang chi tiết sản phẩm
        return redirect('/product/' . $request->product_id)->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}