<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ
        DB::table('products')->truncate();

        // Danh sách sản phẩm
        $products = [

            [
                'name' => 'Áo Khoác Denim Nam',
                'slug' => 'ao-khoac-denim-nam',
                'description' => 'Áo khoác denim phong cách trẻ trung, phù hợp đi chơi và đi làm.',
                'price' => 550000,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1559551409-dadc959f76b8?auto=format&fit=crop&w=400&q=80',
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Váy Đỏ Thời Trang Nữ',
                'slug' => 'vay-do-thoi-trang-nu',
                'description' => 'Váy đỏ sang trọng dành cho các buổi tiệc và sự kiện.',
                'price' => 1500000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=400&q=80',
                'category_id' => 2,
                'created_at' => Carbon::now()->subMinutes(10),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Áo Thun Cổ Tròn Basic',
                'slug' => 'ao-thun-co-tron-basic',
                'description' => 'Áo thun cotton 100% mềm mại, thoáng mát.',
                'price' => 250000,
                'stock' => 80,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=400&q=80',
                'category_id' => 3,
                'created_at' => Carbon::now()->subMinutes(20),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Túi Xách Da Cao Cấp',
                'slug' => 'tui-xach-da-cao-cap',
                'description' => 'Túi xách da thật phong cách sang trọng.',
                'price' => 890000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=400&q=80',
                'category_id' => 5,
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Quần Jean Nữ Ống Rộng',
                'slug' => 'quan-jean-nu-ong-rong',
                'description' => 'Quần jean phong cách trẻ trung, dễ phối đồ.',
                'price' => 450000,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=400&q=80',
                'category_id' => 4,
                'created_at' => Carbon::now()->subMinutes(40),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Áo Sơ Mi Nam Công Sở',
                'slug' => 'ao-so-mi-nam-cong-so',
                'description' => 'Áo sơ mi lịch lãm dành cho môi trường công sở.',
                'price' => 350000,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=400&q=80',
                'category_id' => 1,
                'created_at' => Carbon::now()->subMinutes(50),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Mắt Kính Thời Trang',
                'slug' => 'mat-kinh-thoi-trang',
                'description' => 'Mắt kính phong cách thời trang trẻ trung.',
                'price' => 150000,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=400&q=80',
                'category_id' => 5,
                'created_at' => Carbon::now()->subHour(1),
                'updated_at' => Carbon::now(),
            ],

            [
                'name' => 'Giày Sneaker Thể Thao',
                'slug' => 'giay-sneaker-the-thao',
                'description' => 'Giày sneaker năng động, phù hợp hoạt động thể thao.',
                'price' => 750000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=400&q=80',
                'category_id' => 5,
                'created_at' => Carbon::now()->subHour(2),
                'updated_at' => Carbon::now(),
            ],

        ];

        DB::table('products')->insert($products);
    }
}