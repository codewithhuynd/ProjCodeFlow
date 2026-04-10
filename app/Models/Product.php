<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // ĐỂ CẤP QUYỀN CẬP NHẬT:
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
        'category_id', 
        'slug',
    ];

    //  Mối quan hệ: 1 Sản phẩm có nhiều Đánh giá
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}