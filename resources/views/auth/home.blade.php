<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Thời Trang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Reset cơ bản */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
        }

        /* --- HEADER --- */
        header {
            background-color: #1e3a8a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 40px;
        }

        .logo-nav {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .logo {
            font-weight: bold;
            font-size: 20px;
            background: #fff;
            color: #1e3a8a;
            padding: 5px 10px;
            border-radius: 4px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #93c5fd;
        }

        /* --- KHU VỰC CÁC NÚT TƯƠNG TÁC (TÌM KIẾM, BỘ LỌC, GIỎ HÀNG, AUTH) --- */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-bar {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
            display: flex;
            align-items: center;
            padding: 5px 15px;
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: #fff;
            padding: 5px;
            outline: none;
            width: 150px;
        }

        .search-bar input::placeholder {
            color: #bfdbfe;
        }

        .search-bar i {
            color: #bfdbfe;
        }

        .icons i {
            font-size: 18px;
            margin-left: 10px;
            cursor: pointer;
            transition: color 0.3s;
            color: #fff;
        }

        .icons i:hover {
            color: #93c5fd;
        }

        /* Nút Đăng nhập / Đăng ký / Đăng xuất */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 15px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            padding-left: 15px;
        }

        .auth-buttons a,
        .btn-logout {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            padding: 6px 15px;
            border-radius: 4px;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-login:hover {
            color: #93c5fd;
        }

        .btn-register {
            background-color: #2563eb;
        }

        .btn-register:hover {
            background-color: #1d4ed8;
        }

        .btn-logout {
            border: 1px solid #fff;
            background: transparent;
        }

        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* --- CÁC PHẦN CÒN LẠI CỦA TRANG (GIỮ NGUYÊN) --- */
        .hero {
            background-color: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 60px 80px;
            min-height: 500px;
        }

        .hero-content {
            flex: 1;
            padding-right: 50px;
        }

        .hero-number {
            font-size: 100px;
            font-weight: 900;
            color: transparent;
            -webkit-text-stroke: 2px #1e3a8a;
            line-height: 1;
            margin-bottom: 20px;
        }

        .hero-content h1 {
            font-size: 42px;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 18px;
            color: #3b82f6;
            margin-bottom: 40px;
            max-width: 80%;
        }

        .btn-shop {
            background-color: #2563eb;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border-radius: 4px;
            transition: background 0.3s, transform 0.2s;
            display: inline-block;
        }

        .btn-shop:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .hero-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15);
        }

        .flash-sale {
            background-color: #1e40af;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
        }

        .flash-sale-title {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flash-sale-link {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .flash-sale-link:hover {
            color: #bfdbfe;
        }

        .products {
            padding: 40px 80px;
            background: #f8fafc;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .product-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 300px;
            background-color: #f0f0f0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #2563eb;
            color: #fff;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 4px;
        }

        .product-info {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price {
            display: flex;
            flex-direction: column;
        }

        .old-price {
            text-decoration: line-through;
            color: #94a3b8;
            font-size: 13px;
        }

        .new-price {
            color: #2563eb;
            font-weight: bold;
            font-size: 16px;
        }

        .btn-add {
            background-color: #1e3a8a;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background-color: #2563eb;
        }

        footer {
            background-color: #0f172a;
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 20px 80px;
            align-items: center;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            gap: 30px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-socials i {
            font-size: 20px;
            margin-left: 15px;
            cursor: pointer;
            color: #94a3b8;
            transition: color 0.3s;
        }

        .footer-socials i:hover {
            color: #60a5fa;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo-nav">
            <img src="/images/logo.png" height="40">
            <nav>
                <ul>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Nữ</a></li>
                    <li><a href="#">Nam</a></li>
                    <li><a href="#">Áo</a></li>
                    <li><a href="#">Quần</a></li>
                    <li><a href="#">Phụ Kiện</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </nav>
        </div>

        <div class="header-actions">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="TÌM KIẾM...">
            </div>

            <div class="icons">
                <i class="fas fa-filter" title="Bộ lọc"></i>
                <i class="fas fa-shopping-cart" title="Giỏ hàng"></i>
            </div>

            <div class="auth-buttons">
                @auth
                <span style="font-size: 14px; color: #93c5fd;">Chào, <strong>{{ Auth::user()->name }}</strong></span>

                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Đăng xuất</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn-login">Đăng nhập</a>
                <a href="/register" class="btn-register">Đăng ký</a>
                @endauth
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-number">36</div>
            <h1>BỘ SƯU TẬP THỜI TRANG MỚI</h1>
            <p>Khám phá xu hướng thời trang mới nhất với phong cách độc đáo</p>
            <a href="#" class="btn-shop">MUA SẮM NGAY</a>
        </div>
        <div class="hero-image">
            <img src="data:image/jpeg;base64,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" alt="Người mẫu thời trang">
        </div>
    </section>

    <div class="flash-sale">
        <div class="flash-sale-title">
            <i class="fas fa-bolt"></i> NEW ✨✨✨
        </div>
        <a href="#" class="flash-sale-link">Xem tất cả &rarr;</a>
    </div>

    <section class="products">
        @if(isset($products) && $products->count() > 0)
        @foreach($products as $product)

        <a href="{{ route('product.show', $product->id) }}" style="text-decoration:none; color:inherit;">
            <div class="product-card">
                <div class="product-image">
                    <div class="badge">MỚI</div>
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>

                <div class="product-info">
                    <div class="price">
                        <span style="font-weight: bold; color: #1e3a8a;">
                            {{ $product->name }}
                        </span>

                        <span class="new-price">
                            {{ number_format($product->price, 0, ',', '.') }}đ
                        </span>
                    </div>

                    <button class="btn-add">Thêm vào giỏ</button>
                </div>
            </div>
        </a>

        @endforeach
        @else
        <p style="grid-column: span 4; text-align: center; color: #64748b; padding: 20px;">
            Chưa có sản phẩm nào. Vui lòng thêm sản phẩm từ trang Admin!
        </p>
        @endif
    </section>

    <footer>
        <div class="footer-links">
            <a href="#">Về chúng tôi</a>
            <a href="#">Hỗ trợ khách hàng</a>
            <a href="#">Chính sách bảo mật</a>
            <a href="#">Liên hệ</a>
        </div>
        <div class="footer-socials">
            <i class="fab fa-instagram"></i>
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
        </div>
    </footer>

</body>

</html>