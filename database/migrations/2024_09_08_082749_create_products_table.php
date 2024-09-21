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
            $table->string('image1', 225);
            $table->string('image2', 225);
            $table->string('image3', 225);
            $table->string('name', 100);
            $table->text('descriptions');
            $table->float('price');
            $table->string('stock', 100);
            $table->foreignId('category_id')->nullable()
                ->constrained('categorys') // Defaultnya akan merujuk ke kolom 'id'
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
