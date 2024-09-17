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
            $table->unsignedBigInteger('product_id')->unique()->nullable();
            $table->string('image', 225);
            $table->string('name', 100);
            $table->text('descriptions');
            $table->string('price', 100);
            $table->string('stock', 100);
            $table->enum('category', ['baju', 'celana', 'sepatu', 'aksesoris']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
