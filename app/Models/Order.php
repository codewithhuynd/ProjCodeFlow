<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPING = 'shipping';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELED = 'canceled';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PROCESSING,
        self::STATUS_SHIPPING,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELED,
    ];

    public const FINAL_STATUSES = [
        self::STATUS_COMPLETED,
        self::STATUS_CANCELED,
    ];

    // ✅ Cho phép insert dữ liệu
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'total_price',
        'status'
    ];

    // 🔗 1 Order thuộc về 1 User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // 🔗 1 Order có nhiều sản phẩm
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_PENDING => 'Chờ xác nhận',
            self::STATUS_PROCESSING => 'Đang xử lý',
            self::STATUS_SHIPPING => 'Đang giao',
            self::STATUS_COMPLETED => 'Hoàn thành',
            self::STATUS_CANCELED => 'Đã hủy',
            default => $status,
        };
    }

    public static function allowedNextStatuses(string $currentStatus): array
    {
        return match ($currentStatus) {
            self::STATUS_PENDING => [self::STATUS_PROCESSING, self::STATUS_CANCELED],
            self::STATUS_PROCESSING => [self::STATUS_SHIPPING, self::STATUS_CANCELED],
            self::STATUS_SHIPPING => [self::STATUS_COMPLETED, self::STATUS_CANCELED],
            default => [],
        };
    }

    public function isFinal(): bool
    {
        return in_array($this->status, self::FINAL_STATUSES, true);
    }
}