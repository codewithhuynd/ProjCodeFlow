<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #f4f6fb; }
        
        /* Header giữ phong cách giống trang chủ */
        header { background-color: #1e3a8a; color: #fff; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-weight: bold; font-size: 20px; background: #fff; color: #1e3a8a; padding: 5px 10px; border-radius: 4px; text-decoration: none; }
        
        /* Container chính */
        .profile-wrapper { max-width: 700px; margin: 50px auto; background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .profile-header { text-align: center; margin-bottom: 30px; }
        .profile-header h2 { color: #1e3a8a; font-size: 28px; }

        /* Phần Avatar */
        .avatar-section { position: relative; width: 150px; margin: 0 auto 30px; text-align: center; }
        .avatar-preview { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #eff6ff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .file-input-label { margin-top: 10px; display: inline-block; color: #2563eb; cursor: pointer; font-size: 14px; font-weight: bold; }
        .file-input-label:hover { text-decoration: underline; }
        input[type="file"] { display: none; }

        /* Form fields */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group label { font-weight: 600; color: #475569; font-size: 14px; }
        .form-group input { padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: 0.3s; }
        .form-group input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }

        /* Nút bấm */
        .btn-group { margin-top: 30px; display: flex; gap: 15px; }
        .btn-save { flex: 2; background: #1e3a8a; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #1e40af; transform: translateY(-2px); }
        .btn-back { flex: 1; background: #f1f5f9; color: #475569; text-align: center; text-decoration: none; padding: 15px; border-radius: 8px; font-weight: bold; }
        
        /* Thông báo */
        .alert-success { background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>

<header style="background-color: #1e3a8a; color: #fff; padding: 15px 40px; display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px; width: auto;">
        <span style="font-weight: bold; font-size: 20px;">Fashion Haven</span>
    </div>
</header>

<div class="profile-wrapper">
    <div class="profile-header">
        <h2>Thông tin cá nhân</h2>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="avatar-section" style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('images/ảnh đại diện mặc định.jpg') }}" 
                class="avatar-preview" 
                style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <p style="margin-top: 10px; color: #64748b; font-size: 13px; font-style: italic;">Ảnh đại diện cố định</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="form-group">
                <label>Email (Tài khoản)</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="Chưa cập nhật">
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" value="{{ Auth::user()->address }}" placeholder="Chưa cập nhật">
            </div>
        </div>

        <div class="btn-group">
            <a href="/home" class="btn-back">Quay lại</a>
            <button type="submit" class="btn-save">LƯU THÔNG TIN</button>
        </div>
    </form>
</div>

<script>
    // Hàm xem trước ảnh khi chọn file
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imgPreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>