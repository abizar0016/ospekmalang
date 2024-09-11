<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key default
            $table->string('image', 225)->nullable(); // Tidak perlu ->change() saat membuat kolom baru
            $table->string('uname');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['admin', 'user'])->default('user');

            // Kolom nullable foreign keys
            $table->foreignId('product_id')->nullable()
                ->constrained('products', 'product_id')
                ->onDelete('set null');
            $table->foreignId('message_id')->nullable()
                ->constrained('messages', 'message_id')
                ->onDelete('set null');

            $table->timestamps(); // Taruh timestamps di bagian akhir
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
