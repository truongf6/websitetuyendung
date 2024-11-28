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
        Schema::create('admin_money', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID chính
            $table->decimal('amount', 15, 2); // Số tiền biến động
            $table->text('description')->nullable(); // Mô tả giao dịch
            $table->unsignedBigInteger('user_id')->nullable(); // ID công ty (nếu áp dụng)
            $table->decimal('admin_balance', 15, 2)->default(0); // Tổng số tiền hiện tại trong hệ thống
            $table->timestamps(); 
        
            // Liên kết khóa ngoại tới bảng user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admmin_money');
    }
};
