<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Tắt kiểm tra foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('categories')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [

            [
                'name' => 'Áo Nam',
                'slug' => 'ao-nam',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'Váy Nữ',
                'slug' => 'vay-nu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'Áo Thun',
                'slug' => 'ao-thun',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'Quần Jean',
                'slug' => 'quan-jean',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => 'Phụ Kiện',
                'slug' => 'phu-kien',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ];

        DB::table('categories')->insert($categories);
    }
}