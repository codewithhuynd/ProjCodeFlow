<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

<!-- Import thư viện Bootstrap 5 để có sẵn các class CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
    body {
        margin: 0;
        background: #2f2f2f; /* nền xám đậm */
    }

    .sidebar {
        width: 220px;
        height: 100vh;
        position: fixed;
        background: linear-gradient(180deg, #4e73df, #224abe);
        padding: 20px;
        color: white;
    }

    .sidebar a {
        display: block;
        padding: 10px;
        border-radius: 8px;
        text-decoration: none;
        color: white; /* chữ trắng */
        margin-bottom: 10px;
    }

    .content {
        margin-left: 220px;
        padding: 20px;
    }

    .card-box {
        padding: 20px;
        border-radius: 12px;
        background: #3d3d3d; /* thẻ màu xám */
        color: white; /* chữ trắng để dễ đọc */
        box-shadow: 0 5px 15px rgba(0,0,0,0.3); /* bóng rõ hơn */
        height: 100%;
    }
    .navbar-custom {
        background: linear-gradient(90deg, #1e3c72, #2a5298); /* nền như cũ */
    }
    .navbar-custom .navbar-brand,
    .navbar-custom a,
    .navbar-custom span {
        color: white !important; /* tất cả chữ trắng */
    }

    .text-white-custom {
        color: white;
    }

    .sidebar .menu-item {
        display: block;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 10px;
        color: white;
        text-decoration: none;
    }

    .sidebar .active {
        background: rgba(0,0,0,0.3);
    }

</style>

</head>

<body>

<!-- Thanh điều hướng trên cùng (Navbar)-->

<nav class="navbar navbar-custom px-3">

    <!-- LOGO -->
    <img src="/images/logo.png" height="40">
    <span class="ms-2 fw-bold">Fashion Haven</span>
    <!-- RIGHT -->
    <div class="d-flex align-items-center gap-3 ms-auto">
        <span class="navbar-brand m-0">Admin Panel</span>
        <a href="/admin/logout" class="btn btn-outline-light btn-sm">Đăng xuất</a>
    </div>

</nav>

<!--Thanh menu bên trái (Sidebar)-->

<div class="sidebar">
    <h5 class="text-white">MENU ADMIN</h5>

    <div class="menu-item navbar-custom text-white">Dashboard</div>

    <a href="#" class="menu-item text-white">
        <i class="bi bi-box-seam"></i> Quản lý sản phẩm
    </a>
    <a href="#" class="menu-item text-white">
        <i class="bi bi-receipt"></i> Quản lý đơn hàng
    </a>

</div>

<!-- phần này hiển thị thông tin tổng quan. 
 row chia thành 3 cột thẻ thống kê (col-md-4), mỗi cột là một card-box. -->
<div class="content text-white-custom">
<h2>Dashboard</h2>

<div class="row mt-4">

    <div class="col-md-3 d-flex">
        <div class="card-box">
            <h6>SẢN PHẨM</h6>
            <h2>{{ $totalProducts }}</h2>
            <p>Tổng số sản phẩm trong hệ thống.</p>
        </div>
    </div>

    <div class="col-md-3 d-flex">
        <div class="card-box">
            <h6>ĐƠN HÀNG</h6>
            <h2>{{ $totalOrders }}</h2>
            <p>Sẽ cập nhật khi có chức năng đặt hàng.</p>
        </div>
    </div>

    <div class="col-md-3 d-flex">
        <div class="card-box">
            <h6>NGƯỜI DÙNG</h6>
            <h2>{{ $totalUsers }}</h2>
            <p>Sẽ cập nhật khi thống kê user.</p>
        </div>
    </div>
    
    <div class="col-md-3 d-flex">
        <div class="card-box">
            <h6>TỒN KHO</h6>
            <h2>{{ $totalStock }}</h2>
            <p>Tổng số lượng tồn.</p>
        </div>
    </div>

</div>

</div>

</body>
</html>
