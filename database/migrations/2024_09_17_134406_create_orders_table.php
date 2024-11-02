<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('alamat');
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->enum('payment_status', ['dibayar', 'jatuh tempo', 'belum dibayar']);
            $table->enum('order_status', ['tertunda', 'dikirim', 'dalam pengerjaan', 'dikembalikan']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
