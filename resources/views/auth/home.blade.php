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

        .filter-dropdown {
            position: relative;
            display: inline-block;
        }

        .filter-content {
            display: none;
            position: absolute;
            right: 0;
            top: 30px;
            background-color: #ffffff;
            min-width: 220px;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            border-radius: 8px;
            overflow: hidden;
        }

        .filter-content.show {
            display: block;
        }

        .filter-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.2s;
        }

        .filter-content a:last-child {
            border-bottom: none;
        }

        .filter-content a:hover {
            background-color: #f8fafc;
            color: #1e3a8a;
            font-weight: bold;
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

        .sort-bar {
            padding: 20px 80px;
            display: flex;
            justify-content: flex-end;
            background: #f8fafc;
        }

        .sort-bar select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #cbd5f5;
            font-size: 14px;
            cursor: pointer;
        }

        /* Khung ngoài của Popup */
        .cart-popup {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            width: 360px;
            /* Rộng hơn một chút để chứa đủ nút tăng giảm và giá */
            background-color: #ffffff;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 1000;
            padding: 10px;
            max-height: 450px;
            overflow-y: auto;
            text-align: left;
            cursor: default;
            /* Tránh bị dính hiệu ứng con trỏ trỏ vào link của thẻ cha */
        }

        .cart-popup.show {
            display: block;
        }

        .empty-cart-msg {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .cart-item-checkbox {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        .cart-item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .cart-item-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e3a8a;
        }

        .cart-item-price {
            font-size: 13px;
            color: #ef4444;
            font-weight: bold;
        }

        .cart-qty-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cart-qty-btn {
            width: 20px;
            height: 20px;
            text-align: center;
            border: 1px solid #ccc;
            background: #fff;
            cursor: pointer;
            border-radius: 3px;
            line-height: 18px;
        }

        .cart-qty-input {
            width: 30px;
            text-align: center;
            border: 1px solid #ccc;
            height: 20px;
            font-size: 12px;
        }

        .cart-footer {
            padding: 15px 10px;
            border-top: 2px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        .btn-order-dummy {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
        }

        .cart-total-row span {
            font-size: 15px !important;
            text-transform: none !important;
        }
    </style>
</head>

<body>
    @if(session('success'))
    <script>
        alert("{{ session('success') }}")
    </script>
    @endif
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
                </ul>
            </nav>
        </div>

        <form action="{{ route('products.search') }}" method="GET" class="search-bar">
            <button type="submit" style="background: none; border: none; color: #bfdbfe; cursor: pointer; padding: 0;">
                <i class="fas fa-search"></i>
            </button>
            <input type="text" name="query" placeholder="TÌM KIẾM..." value="{{ request('query') }}">
        </form>

        @php
        $totalQuantity = 0;
        if(Auth::check()) {
        $totalQuantity = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
        }
        @endphp

        <div class="icons" style="display: flex; align-items: center; gap: 20px;">
            <div class="filter-dropdown">
                <i class="fas fa-filter" title="Bộ lọc" onclick="toggleFilter()" style="cursor: pointer;"></i>

                <div id="myFilterDropdown" class="filter-content">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">
                        Sắp xếp giá tăng dần
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">
                        Sắp xếp giá giảm dần
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}">
                        Mặc định
                    </a>
                </div>
            </div>

            <div id="cart-wrapper" style="position: relative; display:inline-block; cursor: pointer;">
                <div onclick="toggleCartPopup(event)">
                    <i class="fas fa-shopping-cart" title="Giỏ hàng"></i>
                    <span id="cart-count" style="position: absolute; top: -8px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; display: {{ $totalQuantity > 0 ? 'inline-block' : 'none' }};">
                        {{ $totalQuantity }}
                    </span>
                </div>
                <div id="cart-popup" class="cart-popup">
                    <div id="cart-items-container"></div>
                </div>
            </div>
        </div>

        <div class="auth-buttons" style="display: flex; align-items: center; gap: 15px;">
            @auth
            @if(Auth::user()->is_admin)
            <span style="font-size: 14px; color: #ef4444;">Đang dùng quyền Quản trị</span>
            <a href="/admin/dashboard" style="background-color: #1e3a8a; color: white; padding: 6px 15px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;">
                Vào Trang Admin
            </a>

            <div style="display: flex; flex-direction: column; align-items: center;">
                <form method="POST" action="{{ route('logout') }}" style="margin: 0; width: 100%;">
                    @csrf
                    <button type="submit" class="btn-logout" style="width: 100%;">Đăng xuất</button>
                </form>
                <a href="{{ route('password.change') }}" style="color: #bfdbfe; font-size: 12px; text-decoration: underline; margin-top: 5px;">
                    Đổi mật khẩu?
                </a>
            </div>

            @else
            <span style="font-size: 14px; color: #93c5fd;">Chào <strong>{{ Auth::user()->name }}</strong></span>
            <a href="{{ route('orders.my') }}" style="color:#fff; text-decoration:none; font-weight:bold; font-size:14px; padding:6px 12px; border-radius:4px; border: 1px solid rgba(255,255,255,0.35);">
                Đơn hàng của tôi
            </a>

            <div style="display: flex; flex-direction: column; align-items: center;">
                <form method="POST" action="{{ route('logout') }}" style="margin: 0; width: 100%;">
                    @csrf
                    <button type="submit" class="btn-logout" style="width: 100%;">Đăng xuất</button>
                </form>
                <a href="{{ route('password.change') }}" style="color: #bfdbfe; font-size: 12px; text-decoration: underline; margin-top: 5px;">
                    Bạn muốn đổi mật khẩu?
                </a>
            </div>
            @endif

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
            <img src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/08/pikachu-game-3.jpg" alt="Người mẫu thời trang">
        </div>
    </section>

    <div class="flash-sale">

        <div class="flash-sale-title">
            <i class="fas fa-bolt"></i> NEW ✨✨✨
        </div>
        <a href="#" class="flash-sale-link">Xem tất cả &rarr;</a>
    </div>

    <section class="products">
        @forelse($products as $product)

        <div class="product-card">
            <a href="{{ route('product.show', $product->id) }}" style="text-decoration:none; color:inherit;">
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

                    <button class="btn-add" onclick="addToCart(event, {{ $product->id }});">Thêm vào giỏ</button>
                </div>
            </a>
        </div>

        @empty
        <p style="grid-column: span 4; text-align: center; color: #64748b; padding: 20px;">
            Chưa có sản phẩm nào. Hãy đón chờ các sản phẩm mới nhé!
        </p>
        @endforelse
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
    <script>
        function addToCart(event, productId) {
            event.preventDefault();
            event.stopPropagation();

            fetch('/add-to-cart/' + productId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: 1
                    }) // Mặc định thêm 1
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        let badge = document.getElementById('cart-count');
                        if (badge) {
                            badge.innerText = data.cartCount;
                            badge.style.display = 'inline-block';
                        }
                    }
                }).catch(error => console.error('Lỗi:', error));
        }

        function toggleFilter() {
            document.getElementById("myFilterDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.fa-filter')) {
                var dropdowns = document.getElementsByClassName("filter-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        function toggleCartPopup(event) {
            if (event) event.stopPropagation();
            const popup = document.getElementById('cart-popup');
            popup.classList.toggle('show');
            if (popup.classList.contains('show')) loadCartItems();
        }

        function loadCartItems() {
            const container = document.getElementById('cart-items-container');
            container.innerHTML = '<div class="empty-cart-msg">Đang tải...</div>';

            fetch('/cart-details')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        container.innerHTML = '<div class="empty-cart-msg">Giỏ hàng trống</div>';
                        return;
                    }

                    let html = '';
                    data.forEach(item => {
                        let product = item.product;
                        let imageSrc = product.image.startsWith('http') ? product.image : `/${product.image}`;

                        html += `
                            <div class="cart-item">
                                <input type="checkbox" class="cart-item-checkbox" id="cart-check-${item.id}" data-price="${product.price}" data-qty="${item.quantity}" onchange="calculateTotal()">
                                <img src="${imageSrc}" alt="${product.name}">
                                <div class="cart-item-info">
                                    <div class="cart-item-name">${product.name}</div>
                                    <div class="cart-item-price">${new Intl.NumberFormat('vi-VN').format(product.price)}đ</div>
                                    <div class="cart-qty-controls">
                                        <button class="cart-qty-btn" onclick="updatePopupQty(${item.id}, 'decrease')">-</button>
                                        <input type="text" class="cart-qty-input" id="cart-qty-${item.id}" value="${item.quantity}" readonly>
                                        <button class="cart-qty-btn" onclick="updatePopupQty(${item.id}, 'increase')">+</button>
                                    </div>
                                </div>
                            </div>`;
                    });

                    // Thêm phần Footer (Tổng tiền + Nút đặt hàng tượng trưng)
                    html += `
                        <div class="cart-footer">
                            <div class="cart-total-row">
                                <span>Tổng tiền dự kiến:</span>
                                <span id="cart-total-price" style="color: #ef4444;">0đ</span>
                            </div>
                            <button class="btn-order-dummy" onclick="goToCheckout()">ĐẶT HÀNG NGAY</button>
                        </div>
                    `;

                    container.innerHTML = html;
                });
        }

        // Cập nhật số lượng khi bấm +/- trong popup
        function updatePopupQty(cartId, action) {
            let qtyInput = document.getElementById('cart-qty-' + cartId);
            let checkbox = document.getElementById('cart-check-' + cartId);
            let currentQty = parseInt(qtyInput.value);

            let newQty = currentQty;
            if (action === 'increase') newQty++;
            else if (action === 'decrease' && currentQty > 1) newQty--;

            if (newQty === currentQty) return;

            fetch('/update-cart', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        cart_id: cartId,
                        action: action
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        let badge = document.getElementById('cart-count');
                        if (badge) badge.innerText = data.cartCount;

                        qtyInput.value = newQty;
                        if (checkbox) checkbox.setAttribute('data-qty', newQty);

                        calculateTotal();
                    }
                });
        }
        // Tính tổng tiền dựa trên các ô checkbox được tick
        function calculateTotal() {
            let total = 0;
            let checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');

            checkboxes.forEach(box => {
                let price = parseFloat(box.getAttribute('data-price'));
                let qty = parseInt(box.getAttribute('data-qty'));
                total += price * qty;
            });

            document.getElementById('cart-total-price').innerText = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
        }

        function goToCheckout() {
            let selected = [];

            document.querySelectorAll('.cart-item-checkbox:checked').forEach(box => {
                let id = box.id.replace('cart-check-', '');
                selected.push(id);
            });

            if (selected.length === 0) {
                alert("Bạn chưa chọn sản phẩm!");
                return;
            }

            fetch('/checkout-selected', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        selected: selected
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/checkout';
                    }
                });
        }
    </script>
</body>

</html>