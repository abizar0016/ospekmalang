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
        Schema::create('product', function (Blueprint $table) {
            $table->id('idproduct');
            $table->string('image', 225);
            $table->string('name', 100);
            $table->text('deskripsi');
            $table->string('price', 100);
            $table->string('stock', 100);
            $table->enum('category', ['baju', 'celana', 'sepatu', 'aksesoris'])->default('baju');
        });
        
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};    
