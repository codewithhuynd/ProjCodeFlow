<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'order_id', 'rating', 'comment'];

    // Mối quan hệ: 1 Đánh giá thuộc về 1 User
    public function user() {
        return $this->belongsTo(User::class);
    }
}