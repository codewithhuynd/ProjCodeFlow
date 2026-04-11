<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-blue-100">
        <h2 class="text-3xl font-bold text-blue-900 mb-6 text-center">Đổi Mật Khẩu 🔒</h2>

        <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-5">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block text-gray-700 font-bold mb-2">Mật khẩu hiện tại</label>
                <div class="relative">
                    <input type="password" name="old_password" id="old_password" required placeholder="Nhập mật khẩu cũ..." 
                           class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" onclick="togglePassword('old_password', 'eye_old')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-blue-500">
                        <i id="eye_old" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Mật khẩu mới</label>
                <div class="relative">
                    <input type="password" name="new_password" id="new_password" required placeholder="Ít nhất 6 ký tự..." 
                           class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" onclick="togglePassword('new_password', 'eye_new')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-blue-500">
                        <i id="eye_new" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Xác nhận mật khẩu mới</label>
                <div class="relative">
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required placeholder="Nhập lại mật khẩu mới..." 
                           class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" onclick="togglePassword('new_password_confirmation', 'eye_confirm')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-blue-500">
                        <i id="eye_confirm" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 transition shadow-md shadow-blue-200">
                Cập nhật mật khẩu
            </button>
            
            <div class="text-center mt-4">
                <a href="/home" class="text-blue-500 hover:underline text-sm">&larr; Quay lại Trang chủ</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>