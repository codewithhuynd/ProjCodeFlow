<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} | GUCO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
        }

        /* ================= HEADER STYLE ================= */
        header {
            background-color: #1e3a8a;
            color: #fff;
            padding: 10px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-nav { display: flex; align-items: center; gap: 40px; }
        .logo-nav img { height: 45px; cursor: pointer; transition: 0.3s; }
        .logo-nav img:hover { transform: scale(1.05); }

        nav ul {
            display: flex;
            list-style: none;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .header-actions { display: flex; align-items: center; gap: 25px; }

        .search-bar {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 6px 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .search-bar input {
            background: transparent;
            border: none;
            color: #fff;
            outline: none;
            margin-left: 8px;
            width: 140px;
            font-size: 13px;
        }

        .action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .action-item i { font-size: 18px; }
        .action-item span { font-size: 10px; text-transform: uppercase; }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            padding-left: 20px;
        }

        .user-info { font-size: 13px; text-align: right; line-height: 1.2; }
        
        .btn-logout-white {
            border: 1px solid #fff;
            background: transparent;
            color: #fff;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-logout-white:hover { background: #fff; color: #1e3a8a; }

        /* ================= CONTAINER & PRODUCT ================= */
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }

        .btnHome {
            margin-bottom: 20px;
            padding: 10px 18px;
            background-color: #1e3a8a;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
        }

        .product {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .product-image img { width: 100%; border-radius: 8px; }

        .product-info h1 { margin: 0 0 10px 0; font-size: 32px; color: #333; }
        .category { color: #999; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; }
        .price { color: #1e3a8a; font-size: 30px; font-weight: bold; margin: 20px 0; }
        .description { color: #666; line-height: 1.7; border-top: 1px solid #eee; padding-top: 20px; }

        .option-title { margin-top: 25px; font-weight: bold; color: #333; text-transform: uppercase; font-size: 14px; }
        .options { margin-top: 10px; display: flex; flex-wrap: wrap; gap: 12px; }
        
        .options button {
            padding: 12px 20px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }

        .options button.active {
            background-color: #1e3a8a;
            color: white;
            border-color: #1e3a8a;
        }

        .quantity { display: flex; align-items: center; margin-top: 15px; }
        .quantity button { width: 40px; height: 40px; border: 1px solid #ddd; background: #fff; font-size: 20px; cursor: pointer; }
        .quantity input { width: 60px; text-align: center; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; border-left: none; border-right: none; height: 40px; font-weight: bold; }

        .actions { margin-top: 40px; display: flex; gap: 20px; }
        .add-cart {
            flex: 1;
            padding: 16px;
            background: #fff;
            border: 2px solid #1e3a8a;
            color: #1e3a8a;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .buy-now {
            flex: 1;
            padding: 16px;
            background: #1e3a8a;
            border: none;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .stock { margin-top: 15px; color: #22c55e; font-weight: 500; font-size: 14px; }
    </style>
</head>

<body>

    <header>
        <div class="logo-nav">
            <a href="/home">
                <img src="{{ asset('images/logo.png') }}" alt="Logo GUCO">
            </a>
            <nav>
                <ul>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Nữ</a></li>
                    <li><a href="#">Nam</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </nav>
        </div>

        <form action="{{ route('products.search') }}" method="GET" class="search-bar">
            <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; padding: 0;">
                <i class="fas fa-search"></i>
            </button>
            <input type="text" name="query" placeholder="TÌM KIẾM..." value="{{ request('query') }}">
        </form>

            <div class="action-item">
                <i class="fas fa-filter"></i>
                <span>Bộ lọc</span>
            </div>

            <a href="/cart" class="action-item">
                @php
                    $cart = session('cart', []);
                    $totalQuantity = 0;
                    foreach ($cart as $item) {
                        $totalQuantity += $item['quantity'];
                    }
                @endphp

                <div style="position: relative; display:inline-block;">
                    <i class="fas fa-shopping-cart"></i>

                    @if($totalQuantity > 0)
                        <span id="cart-count" style="
                            position: absolute;
                            top: -8px;
                            right: -10px;
                            background: red;
                            color: white;
                            border-radius: 50%;
                            padding: 2px 6px;
                            font-size: 12px;
                        ">
                            {{ $totalQuantity }}
                        </span>
                    @endif
                </div>
                <span>Giỏ hàng</span>
            </a>
            
            <div class="auth-buttons">
                @auth
                    <div class="user-info">
                        @if(Auth::user()->is_admin)
                            <span style="color: #ff4d4d;"></span><br>
                        @endif
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-logout-white">ĐĂNG XUẤT</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="action-item">
                        <i class="fas fa-user"></i>
                        <span>Đăng nhập</span>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <div class="container">
        <button onclick="window.location.href='/home'" class="btnHome">
            <i class="fas fa-arrow-left"></i> QUAY LẠI
        </button>

        <div class="product">
            <div class="product-image">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            </div>

            <div class="product-info">
                <div class="category">{{ $product->category->name ?? 'Thời trang' }}</div>
                <h1>{{ $product->name }}</h1>
                <div class="price">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                
                <div class="description">
                    {{ $product->description }}
                </div>

                @if(!empty($product->available_colors))
                    <div class="option-title">Màu sắc</div>
                    <div class="options">
                        @foreach($product->available_colors as $color)
                            <button class="color-btn" onclick="selectOption(this, '.color-btn')">{{ $color }}</button>
                        @endforeach
                    </div>
                @endif

                @if(!empty($product->available_sizes))
                    <div class="option-title">Kích thước</div>
                    <div class="options">
                        @foreach($product->available_sizes as $size)
                            <button class="size-btn" onclick="selectOption(this, '.size-btn')">{{ $size }}</button>
                        @endforeach
                    </div>
                @endif

                <div class="option-title">Số lượng</div>
                <div class="quantity">
                    <button onclick="minus()">-</button>
                    <input type="text" id="qty" value="1" readonly>
                    <button onclick="plus()">+</button>
                </div>
                <div class="stock">
                    <i class="fas fa-check-circle"></i> Còn {{ $product->stock }} sản phẩm trong kho
                </div>

                <div class="actions">
                    <button class="add-cart" onclick="addToCart({{ $product->id }})">THÊM VÀO GIỎ HÀNG</button>
                    <button class="buy-now">MUA NGAY</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const maxStock = Number("{{ $product->stock }}");

        function plus() {
            let qtyInput = document.getElementById("qty");
            let currentVal = parseInt(qtyInput.value);
            if(currentVal < maxStock) {
                qtyInput.value = currentVal + 1;
            } else {
                alert('Rất tiếc, kho chỉ còn ' + maxStock + ' sản phẩm!');
            }
        }

        function minus() {
            let qtyInput = document.getElementById("qty");
            let currentVal = parseInt(qtyInput.value);
            if(currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        }

        function selectOption(clickedBtn, groupClass) {
            let allBtns = document.querySelectorAll(groupClass);
            allBtns.forEach(btn => btn.classList.remove('active'));
            clickedBtn.classList.add('active');
        }
        function addToCart(productId) {
            fetch(`/add-to-cart/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                // Hiển thị thông báo trả về từ Controller
                alert(data.message);

                // Chỉ cập nhật badge số lượng nếu thêm mới thành công (success: true)
                if (data.success) {
                    let badge = document.getElementById('cart-count');
                    if (badge) {
                        badge.innerText = data.cartCount;
                        badge.style.display = 'inline-block';
                    }
                }
            })
            .catch(error => console.error('Lỗi:', error));
        }
    </script>

</body>
</html>