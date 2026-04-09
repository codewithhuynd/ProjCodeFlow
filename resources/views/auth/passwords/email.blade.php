<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên Mật Khẩu | GUCO</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .btn { width: 100%; padding: 12px; background: #1e3a8a; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 15px; }
        .input-group { margin-bottom: 15px; }
        .input-group input { width: 93%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="text-align: center; color: #1e3a8a;">QUÊN MẬT KHẨU</h2>
        <p style="font-size: 13px; color: #666; text-align: center;">Nhập email đã đăng ký, GUCO sẽ gửi link đặt lại mật khẩu cho bạn.</p>

        @if (session('status'))
            <div style="background: #d1edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 13px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group">
                <input type="email" name="email" placeholder="Nhập Email của bạn..." required>
                @error('email') <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn">GỬI LINK ĐẶT LẠI MẬT KHẨU</button>
            <div style="text-align: center; margin-top: 15px;">
                <a href="/login" style="color: #1e3a8a; font-size: 13px; text-decoration: none;">&larr; Quay lại Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
</html>