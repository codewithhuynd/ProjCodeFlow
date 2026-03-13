<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Modern UI</title>
    <script src="{{ asset('js/auth.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

<div class="bg-white p-8 rounded-2xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] w-full max-w-md border border-gray-100">

    <div class="text-center mb-10">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
            Tạo tài khoản mới
        </h2>
        <p class="text-gray-500 mt-2">Bắt đầu hành trình mua sắm!</p>
    </div>

    <form method="POST" action="/register" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Họ và tên</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full px-4 py-3 rounded-xl border @error('name') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 outline-none transition-all">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email của bạn</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-xl border @error('email') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 outline-none transition-all">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Mật khẩu</label>
            <div class="relative group">
                <input id="password" type="password" name="password"
                    class="w-full px-4 py-3 rounded-xl border @error('password') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 outline-none transition-all">
                <button type="button" onclick="togglePassword('password', 'eye-icon')" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors p-1">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Xác nhận mật khẩu</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 outline-none transition-all">
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 p-1">
                    <svg id="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 active:scale-[0.98] transition-all shadow-lg shadow-blue-500/30 mt-2">
            Đăng ký ngay
        </button>

        <p class="text-center text-sm text-gray-600 pt-4">
            Đã có tài khoản? 
            <a href="/login" class="text-blue-600 font-semibold hover:underline">Đăng nhập</a>
        </p>
    </form>
</div>

</body>
</html>