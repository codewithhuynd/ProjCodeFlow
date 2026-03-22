<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Thêm 3 dòng này vào để lưu Tên, Giá và Link Ảnh
            $table->string('name');
            $table->integer('price');
            $table->string('image')->nullable(); 
            
            $table->timestamps(); // Cái này Laravel tự tạo để lưu "ngày tạo mới nhất" nè
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
