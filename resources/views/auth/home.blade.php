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

        .auth-buttons a, .btn-logout {
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

        .btn-login:hover { color: #93c5fd; }
        
        .btn-register { background-color: #2563eb; }
        .btn-register:hover { background-color: #1d4ed8; }

        .btn-logout { border: 1px solid #fff; background: transparent; }
        .btn-logout:hover { background-color: rgba(255,255,255,0.1); }

        /* --- CÁC PHẦN CÒN LẠI CỦA TRANG (GIỮ NGUYÊN) --- */
        .hero { background-color: #eff6ff; display: flex; align-items: center; justify-content: space-between; padding: 60px 80px; min-height: 500px; }
        .hero-content { flex: 1; padding-right: 50px; }
        .hero-number { font-size: 100px; font-weight: 900; color: transparent; -webkit-text-stroke: 2px #1e3a8a; line-height: 1; margin-bottom: 20px; }
        .hero-content h1 { font-size: 42px; font-weight: 800; color: #1e3a8a; margin-bottom: 20px; line-height: 1.2; }
        .hero-content p { font-size: 18px; color: #3b82f6; margin-bottom: 40px; max-width: 80%; }
        .btn-shop { background-color: #2563eb; color: #fff; padding: 15px 30px; text-decoration: none; font-weight: bold; font-size: 14px; border-radius: 4px; transition: background 0.3s, transform 0.2s; display: inline-block; }
        .btn-shop:hover { background-color: #1d4ed8; transform: translateY(-2px); }
        .hero-image { flex: 1; display: flex; justify-content: flex-end; }
        .hero-image img { width: 100%; max-width: 500px; border-radius: 15px; object-fit: cover; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15); }
        .flash-sale { background-color: #1e40af; color: #fff; display: flex; justify-content: space-between; align-items: center; padding: 20px 80px; }
        .flash-sale-title { font-size: 24px; font-weight: bold; display: flex; align-items: center; gap: 10px; }
        .flash-sale-link { color: #fff; text-decoration: none; font-weight: bold; transition: color 0.3s; }
        .flash-sale-link:hover { color: #bfdbfe; }
        .products { padding: 40px 80px; background: #f8fafc; display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
        .product-card { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s, box-shadow 0.3s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1); }
        .product-image { position: relative; width: 100%; height: 300px; background-color: #f0f0f0; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .badge { position: absolute; top: 15px; left: 15px; background-color: #2563eb; color: #fff; padding: 5px 10px; font-size: 12px; font-weight: bold; border-radius: 4px; }
        .product-info { padding: 15px; display: flex; justify-content: space-between; align-items: center; }
        .price { display: flex; flex-direction: column; }
        .old-price { text-decoration: line-through; color: #94a3b8; font-size: 13px; }
        .new-price { color: #2563eb; font-weight: bold; font-size: 16px; }
        .btn-add { background-color: #1e3a8a; color: #fff; border: none; padding: 8px 15px; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 12px; transition: background 0.3s; }
        .btn-add:hover { background-color: #2563eb; }
        footer { background-color: #0f172a; color: #fff; display: flex; justify-content: space-between; padding: 20px 80px; align-items: center; font-size: 14px; }
        .footer-links { display: flex; gap: 30px; }
        .footer-links a { color: #94a3b8; text-decoration: none; transition: color 0.3s; }
        .footer-links a:hover { color: #fff; }
        .footer-socials i { font-size: 20px; margin-left: 15px; cursor: pointer; color: #94a3b8; transition: color 0.3s; }
        .footer-socials i:hover { color: #60a5fa; }
    </style>
</head>
<body>

    <header>
        <div class="logo-nav">
            <div class="logo">LOGO</div>
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
            <img src="duchuygay.jpg" alt="Người mẫu thời trang">
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
                <div class="product-card">
                    <div class="product-image">
                        <div class="badge">MỚI</div>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                        <div class="price">
                            <span style="font-weight: bold; color: #1e3a8a; margin-bottom: 5px; font-size: 15px;">
                                {{ $product->name }}
                            </span>
                            <span class="new-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        </div>
                        <button class="btn-add">Thêm vào giỏ</button>
                    </div>
                </div>
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