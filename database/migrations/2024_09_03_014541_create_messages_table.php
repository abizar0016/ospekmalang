<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->text('reply')->nullable(); // Tambahkan nullable di sini
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('userid')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('messages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
