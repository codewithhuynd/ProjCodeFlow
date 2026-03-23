<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // THÊM ĐOẠN NÀY VÀO ĐỂ CẤP QUYỀN CẬP NHẬT:
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
        'category_id', 
        'slug',
    ];
}
