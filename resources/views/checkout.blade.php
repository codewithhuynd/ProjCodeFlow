<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
        }

        /* HEADER */
        header {
            background-color: #1e3a8a;
            color: white;
            padding: 15px 60px;
            font-size: 20px;
            font-weight: bold;
        }

        /* CONTAINER (Giờ là thẻ Form luôn) */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        /* BOX */
        .box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        h2 {
            margin-bottom: 20px;
            color: #1e3a8a;
        }

        /* INPUT */
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
            box-sizing: border-box;
            transition: 0.2s;
        }

        input:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 2px rgba(30,58,138,0.1);
        }

        /* KHUNG PHƯƠNG THỨC THANH TOÁN */
        .payment-method-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            color: #1e3a8a;
        }

        .payment-method-box span {
            display: block;
            font-size: 13px;
            color: #64748b;
            margin-bottom: 5px;
        }

        .payment-method-box strong {
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* PRODUCT LIST */
        .product-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .product-name {
            font-weight: 500;
        }

        .product-price {
            color: #ef4444;
            font-weight: bold;
        }

        /* TOTAL */
        .total {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .total span:last-child {
            color: #ef4444;
        }

        /* BUTTON */
        button {
            width: 100%;
            padding: 15px;
            margin-top: 10px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #162d6b;
        }

        /* BACK */
        .back {
            display: inline-block;
            margin: 20px 60px;
            color: #1e3a8a;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<header>
    Trang Thanh Toán
</header>

<a href="/home" class="back">← Quay lại</a>

<form class="container" method="POST" action="/place-order">
    @csrf

    <div class="box">
        <h2>Thông tin giao hàng</h2>
        
        <input type="text" name="name" placeholder="Họ tên" value="{{ Auth::user()->name }}" required>
        <input type="text" name="phone" placeholder="SĐT" value="{{ Auth::user()->phone }}" required>
        <input type="text" name="address" placeholder="Địa chỉ" value="{{ Auth::user()->address }}" required>
    </div>

    <div class="box">
        <h2>Đơn hàng của bạn</h2>

        @php $total = 0; @endphp

        @foreach($cartItems as $item)
            @php 
                $subtotal = $item->product->price * $item->quantity;
                $total += $subtotal;
            @endphp

            <div class="product-item">
                <div class="product-name">
                    {{ $item->product->name }} (x{{ $item->quantity }})
                </div>
                <div class="product-price">
                    {{ number_format($subtotal) }}đ
                </div>
            </div>
        @endforeach

        <div class="total" style="margin-bottom: 20px;">
            <span>Tổng:</span>
            <span>{{ number_format($total) }}đ</span>
        </div>

        <div class="payment-method-box">
            <span>Hình thức thanh toán:</span>
            <strong><i class="fas fa-money-bill-wave"></i> Thanh toán khi nhận hàng (COD)</strong>
        </div>

        <button type="submit">ĐẶT HÀNG</button>
    </div>

</form>

</body>
</html>