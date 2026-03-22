<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <!-- Import thư viện Bootstrap 5 để có sẵn các class CSS như form-control, btn, alert, v.v.-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--body: căn giữa nội dung theo chiều ngang và dọc, nền gradient xanh -->
    <!--.login-box: khung trắng chứa form, có bo góc và bóng đổ -->
    <!--.login-title: tiêu đề "Admin Login" căn giữa -->
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg,#4facfe,#00f2fe);
        }

        .login-box{
            width:400px;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        .login-title{
            text-align:center;
            margin-bottom:25px;
            font-weight:bold;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #1e3c72, #2a5298);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom px-3">
        <!-- LOGO -->
        <img src="/images/logo.png" height="40">
        <span class="ms-2 fw-bold text-white">Fashion Haven</span>
    </nav>
    <div class="d-flex justify-content-center align-items-center" style="height:90vh;">
        <div class="login-box">
            <!--Tạo một hộp đăng nhập với tiêu đề Admin Login -->
            <h3 class="login-title">Admin Login</h3>
            <!-- Đoạn này kiểm tra: nếu có lỗi thì hiện ra khung đỏ báo lỗi-->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="/admin/login">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <!-- Ô nhập Email-->
                    <input 
                        type="email"
                        name="email"
                        class="form-control"
                        required
                    >
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required
                        >
                        <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function togglePassword() {
        const password = document.getElementById("password");
        const icon = document.getElementById("eyeIcon");

        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>
</body>
</html>
