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
            $table->string('image', 225);
            $table->string('uname');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['admin', 'user'])->default('user');
            $table->timestamps();

            // Kolom nullable
            $table->foreignId('product_id')->nullable()
                ->constrained('products', 'product_id')
                ->onDelete('set null');
            $table->foreignId('message_id')->nullable()
                ->constrained('messages', 'message_id')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
