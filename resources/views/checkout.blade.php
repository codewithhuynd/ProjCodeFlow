<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán | GUCO</title>

```
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

    /* CONTAINER */
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
        transition: 0.2s;
    }

    input:focus {
        border-color: #1e3a8a;
        box-shadow: 0 0 0 2px rgba(30,58,138,0.1);
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
        margin-top: 20px;
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
```

</head>

<body>

<header>
    GUCO CHECKOUT
</header>

<a href="/home" class="back">← Quay lại</a>

<div class="container">

<!-- FORM -->
<div class="box">
    <h2>Thông tin giao hàng</h2>

    <form method="POST" action="/place-order">
        @csrf

        <input type="text" name="name" placeholder="Họ tên" required>
        <input type="text" name="phone" placeholder="SĐT" required>
        <input type="text" name="address" placeholder="Địa chỉ" required>

        <button type="submit">ĐẶT HÀNG</button>
    </form>
</div>

<!-- CART -->
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

    <div class="total">
        <span>Tổng:</span>
        <span>{{ number_format($total) }}đ</span>
    </div>
</div>


</div>

</body>
</html>
