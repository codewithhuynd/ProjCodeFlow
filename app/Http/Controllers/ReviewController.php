<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($order->status != 'completed') {
            return redirect('/my-orders')->with('error', 'Chỉ được đánh giá khi đơn hàng đã hoàn thành!');
        }

        $review = Review::where('order_id', $id)->first();

        if ($review) {
            return view('review.show', compact('order', 'review'));
        }

        return view('review.create', compact('order'));
    }
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

        return redirect('/home')->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}