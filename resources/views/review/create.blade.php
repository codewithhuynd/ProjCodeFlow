<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá sản phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-2xl w-full bg-white p-8 rounded-2xl shadow-xl border border-blue-100">
        <h2 class="text-3xl font-bold text-blue-900 mb-6 text-center">Đánh giá sản phẩm ⭐</h2>
        
        <form action="{{ route('review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            
            @php
                $productId = $order->items->first()->product_id ?? 1; // Fallback an toàn
            @endphp
            <input type="hidden" name="product_id" value="{{ $productId }}"> 

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Chất lượng sản phẩm (1-5 Sao):</label>
                <select name="rating" required class="w-full border border-gray-300 rounded-lg p-3 text-yellow-600 font-bold outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="5">⭐⭐⭐⭐⭐ Tuyệt vời</option>
                    <option value="4">⭐⭐⭐⭐ Rất tốt</option>
                    <option value="3">⭐⭐⭐ Bình thường</option>
                    <option value="2">⭐⭐ Kém</option>
                    <option value="1">⭐ Rất tệ</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Chia sẻ cảm nhận của bạn:</label>
                <textarea name="comment" rows="4" required placeholder="Sản phẩm mặc có vừa vặn không? Chất vải thế nào..." 
                          class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 transition shadow-md shadow-blue-200">
                Gửi đánh giá
            </button>
            
            <div class="text-center mt-6">
                <a href="/my-orders" class="text-blue-500 hover:underline text-sm">&larr; Hủy và quay lại Đơn hàng</a>
            </div>
        </form>
    </div>

</body>
</html>