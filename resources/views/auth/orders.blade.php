<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
        }

        header {
            background-color: #1e3a8a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 40px;
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

        .page {
            padding: 40px 80px;
        }

        .title {
            color: #1e3a8a;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 14px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .muted {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        .status-pill {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            background: #e2e8f0;
            color: #0f172a;
            text-align: center;
            min-width: 120px;
        }

        .status-pill.pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .status-pill.processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-pill.shipping {
            background: #e0f2fe;
            color: #075985;
        }

        .status-pill.completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-pill.canceled {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>

<body>
    <header>
        <div style="display:flex; align-items:center; gap:20px;">
            <img src="/images/logo.png" height="40" alt="Logo">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('orders.my') }}" style="color: #93c5fd; font-weight: bold;">Đơn hàng của tôi</a></li>
                </ul>
            </nav>
        </div>
        <div style="display:flex; align-items:center; gap:12px;">
            @auth
            <span style="font-size: 14px; color: #93c5fd;">Chào <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="border:1px solid #fff; background:transparent; color:#fff; padding:6px 14px; border-radius:6px; font-weight:700; cursor:pointer;">Đăng xuất</button>
            </form>
            @endauth
        </div>
    </header>

    <div class="page">
        <div class="title">Đơn hàng của tôi</div>

        @if(isset($orders) && $orders->count() > 0)
        @foreach($orders as $order)
        <div class="card">
            <div>
                <div style="font-weight:900; color:#1e3a8a;">Đơn #{{ $order->id }}</div>
                <div class="muted">Tổng tiền: <span style="color:#ef4444; font-weight:900;">{{ number_format($order->total_price, 0, ',', '.') }}đ</span></div>
                <div class="muted">Giao đến: {{ $order->address }}</div>
                <div class="muted">Ngày tạo: {{ $order->created_at }}</div>
            </div>
            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px;">
                <span class="status-pill {{ $order->status }}">{{ \App\Models\Order::statusLabel($order->status) }}</span>
                <div class="muted">Theo dõi tiến độ đơn hàng</div>
            </div>
        </div>
        @endforeach
        @else
        <div class="muted">Bạn chưa có đơn hàng nào.</div>
        @endif
    </div>
</body>

</html>

