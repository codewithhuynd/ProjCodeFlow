<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
        'category_id', 
        'slug',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}