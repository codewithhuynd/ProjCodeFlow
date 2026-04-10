<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đánh giá</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-2xl w-full bg-white p-8 rounded-2xl shadow-xl border border-green-100">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Bạn đã đánh giá đơn hàng này!</h2>
        </div>
        
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
            <div class="mb-4">
                <span class="text-gray-600 font-bold block mb-1">Mức độ hài lòng:</span>
                <div class="text-yellow-500 text-2xl">
                    {{ str_repeat('⭐', $review->rating) }}
                </div>
            </div>

            <div>
                <span class="text-gray-600 font-bold block mb-2">Cảm nhận của bạn:</span>
                <p class="text-gray-800 bg-white p-4 rounded-lg border border-gray-200 italic shadow-sm">
                    "{{ $review->comment }}"
                </p>
            </div>
            
            <p class="text-sm text-gray-400 mt-4 text-right font-medium">
                Gửi lúc: {{ $review->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <div class="text-center mt-8">
            <a href="/my-orders" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-blue-700 transition shadow-md">
                &larr; Quay lại danh sách đơn hàng
            </a>
        </div>
    </div>

</body>
</html>