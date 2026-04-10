<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đơn hàng của tôi</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8fafc;
            padding: 40px;
        }

        h2 {
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        .btn-home {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 16px;
            background: #1e3a8a;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-home:hover {
            background: #1e40af;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #1e3a8a;
            color: white;
        }

        tr:hover {
            background: #f1f5f9;
        }

        .status {
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 13px;
        }

        .pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .shipping {
            background: #e0f2fe;
            color: #075985;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .canceled {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }
    </style>
</head>

<body>

    <a href="{{ url('/home') }}" class="btn-home">← Quay về trang chủ</a>

    <h2>📦 Đơn hàng của tôi</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày</th>
        </tr>

        @forelse($orders as $order)
        @php
        $statusMap = [
        'pending' => ['label' => 'Chờ xác nhận', 'class' => 'pending'],
        'processing' => ['label' => 'Đang xử lý', 'class' => 'processing'],
        'shipping' => ['label' => 'Đang giao', 'class' => 'shipping'],
        'completed' => ['label' => 'Hoàn thành', 'class' => 'completed'],
        'canceled' => ['label' => 'Đã hủy', 'class' => 'canceled'],
        ];
        $st = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => ''];
        @endphp

        <tr>
            <td>#{{ $order->id }}</td>

            <td style="text-align:left;">
                @foreach($order->items as $item)
                <div>
                    • {{ $item->product->name ?? 'N/A' }}
                    (x{{ $item->quantity }})
                </div>
                @endforeach
            </td>

            <td style="color:#ef4444; font-weight:bold;">
                {{ number_format($order->total_price) }}đ
            </td>

            <td>
                <span class="status {{ $st['class'] }}">
                    {{ $st['label'] }}
                </span>
            </td>

            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
        </tr>

        @empty
        <tr>
            <td colspan="5" class="empty">
                Bạn chưa có đơn hàng nào 😢
            </td>
        </tr>
        @endforelse
    </table>

</body>

</html>