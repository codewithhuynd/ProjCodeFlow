<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn Hàng - Admin</title>
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
            display: flex;
            flex-direction: column;
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

        .btn-logout {
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            padding: 6px 15px;
            border-radius: 4px;
            cursor: pointer;
            border: 1px solid #fff;
            background: transparent;
        }

        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .admin-section {
            padding: 40px 80px;
            flex: 1;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .admin-title {
            color: #1e3a8a;
            font-size: 28px;
            font-weight: 800;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .admin-table th,
        .admin-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .admin-table th {
            background-color: #1e3a8a;
            color: white;
            font-weight: bold;
        }

        .admin-table tr:hover {
            background-color: #f1f5f9;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .alert-error {
            background: #fee2e2;
            color: #7f1d1d;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .status-pill {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            background: #e2e8f0;
            color: #0f172a;
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

        .status-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        select {
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            outline: none;
        }

        .btn-save {
            background-color: #10b981;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-save:hover {
            background-color: #059669;
        }

        .muted {
            color: #64748b;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <header>
        <div style="display:flex; align-items:center; gap:20px;">
            <img src="/images/logo.png" height="40" alt="Logo">
            <nav>
                <ul>
                    <li><a href="/admin/dashboard">Dashboard</a></li>
                    <li><a href="{{ route('admin.products') }}">Quản lý sản phẩm</a></li>
                    <li><a href="{{ route('admin.orders') }}" style="color: #93c5fd; font-weight: bold;">Quản lý đơn hàng</a></li>
                </ul>
            </nav>
        </div>
        <div style="display:flex; align-items:center; gap:15px;">
            @auth
            <span style="font-size: 14px; color: #93c5fd;">Chào, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Đăng xuất</button>
            </form>
            @endauth
        </div>
    </header>

    <section class="admin-section">
        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            <i class="fas fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert-error">
            <i class="fas fa-triangle-exclamation"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <div class="admin-header">
            <h2 class="admin-title">Danh sách đơn hàng</h2>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Mã</th>
                    <th>Khách hàng</th>
                    <th style="width: 160px;">SĐT</th>
                    <th>Địa chỉ</th>
                    <th style="width: 150px;">Tổng tiền</th>
                    <th style="width: 160px;">Trạng thái</th>
                    <th style="width: 360px;">Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($orders) && $orders->count() > 0)
                @foreach($orders as $order)
                @php
                $label = \App\Models\Order::statusLabel($order->status);
                $nextStatuses = \App\Models\Order::allowedNextStatuses($order->status);
                @endphp
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>
                        <div style="font-weight:800; color:#1e3a8a;">{{ $order->name }}</div>
                        <div class="muted">{{ $order->user?->email ?? '' }}</div>
                    </td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td style="color:#ef4444; font-weight:800;">{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                    <td>
                        <span class="status-pill {{ $order->status }}">{{ $label }}</span>
                    </td>
                    <td>
                        @if($order->isFinal())
                        <div class="muted">Đơn hàng đã kết thúc, không thể cập nhật.</div>
                        @else
                        <form class="status-form" method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                            @csrf
                            <select name="status" required>
                                <option value="" disabled selected>Chọn trạng thái...</option>
                                @foreach($nextStatuses as $st)
                                <option value="{{ $st }}">{{ \App\Models\Order::statusLabel($st) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-save">Lưu</button>
                        </form>
                        <div class="muted">Luồng chuẩn: Chờ xác nhận → Đang xử lý → Đang giao → Hoàn thành / Đã hủy</div>
                        @endif
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7" style="text-align: center; color: #64748b; padding: 30px;">
                        Chưa có đơn hàng nào.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </section>
</body>

</html>

