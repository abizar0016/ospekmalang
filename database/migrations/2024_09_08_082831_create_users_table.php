<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('image', 225)->nullable();
            $table->string('uname');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['admin', 'user'])->default('user');
            $table->text('bio')->nullable();
            $table->string('phone', 20)->nullable();
            
            $table->date('dob')->nullable();
            $table->string('city', 100)->nullable();
            $table->foreignId('product_id')->nullable() 
                ->constrained('products', 'product_id') 
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
