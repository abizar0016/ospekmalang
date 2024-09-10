<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->unique();
            $table->string('image', 225);
            $table->string('name', 100);
            $table->text('deskripsi');
            $table->string('price', 100);
            $table->string('stock', 100);
            $table->enum('category', ['baju', 'celana', 'sepatu', 'aksesoris'])->default('baju');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
