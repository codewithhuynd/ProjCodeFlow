<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Mật Khẩu Mới</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col items-center justify-center min-h-screen font-sans">

    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-gray-100 w-full max-w-md">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mật khẩu mới</h1>
            <p class="text-gray-500">Vui lòng nhập mật khẩu mới cho tài khoản của bạn.</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-4 rounded-lg text-sm border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email của bạn</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" readonly 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu mới</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="Tối thiểu 6 ký tự..."
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                    
                    <span onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer hover:text-gray-600">
                        <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg id="eyeClosed1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nhập lại mật khẩu</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Nhập lại mật khẩu mới..."
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    
                    <span onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer hover:text-gray-600">
                        <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
                <p id="match-error" class="text-red-500 text-sm mt-1 font-medium hidden">Mật khẩu nhập lại không khớp!</p>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                Xác nhận đổi mật khẩu
            </button>

        </form>
    </div>

    <script>
        function togglePassword(inputId, openIconId, closedIconId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(openIconId);
            const eyeClosed = document.getElementById(closedIconId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // Xử lý kiểm tra mật khẩu khớp nhau trực tiếp
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const submitBtn = document.getElementById('submit-btn');
        const errorMsg = document.getElementById('match-error');
        const form = document.querySelector('form'); 

        // Khóa nút bấm ngay từ đầu khi vừa vào trang
        submitBtn.disabled = true;

        function checkPasswordsMatch() {
            // Nếu 1 trong 2 ô vẫn còn trống -> Tiếp tục khóa nút
            if (passwordInput.value === "" || confirmInput.value === "") {
                errorMsg.classList.add('hidden');
                submitBtn.disabled = true;
                return;
            }

            // Nếu 2 ô khác nhau -> Hiện cảnh báo đỏ và khóa nút bấm
            if (passwordInput.value !== confirmInput.value) {
                errorMsg.classList.remove('hidden');
                submitBtn.disabled = true;
            } else {
                // Nếu khớp nhau 100% -> Ẩn cảnh báo và MỞ KHÓA nút
                errorMsg.classList.add('hidden');
                submitBtn.disabled = false;
            }
        }

        // Lắng nghe từng phím gõ của người dùng
        passwordInput.addEventListener('input', checkPasswordsMatch);
        confirmInput.addEventListener('input', checkPasswordsMatch);

        // Chặn Enter nếu sai
        form.addEventListener('submit', function(event) {
            if (passwordInput.value !== confirmInput.value || passwordInput.value === "") {
                event.preventDefault(); 
                errorMsg.classList.remove('hidden');
                errorMsg.innerText = "Vui lòng nhập mật khẩu khớp nhau trước khi xác nhận!";
            }
        });
    </script>
</body>
</html>