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
            $table->string('image', 225)->nullable(); // Kolom gambar, opsional
            $table->string('uname'); // Username pengguna
            $table->string('email')->unique(); // Email yang unik
            $table->string('password'); // Password
            $table->enum('status', ['admin', 'user'])->default('user'); // Status pengguna (admin/user)
            $table->text('bio')->nullable(); // Kolom bio, bisa kosong
            $table->string('phone', 20)->nullable(); // Kolom phone, bisa kosong, maksimal 20 karakter

            // Kolom nullable untuk foreign key
            $table->foreignId('product_id')->nullable() // Relasi ke tabel produk
                ->constrained('products', 'product_id') // Foreign key dari tabel products
                ->onDelete('set null'); // Set null jika data terkait dihapus
            $table->foreignId('message_id')->nullable() // Relasi ke tabel messages
                ->constrained('messages', 'message_id') // Foreign key dari tabel messages
                ->onDelete('set null'); // Set null jika data terkait dihapus

            // Kolom tambahan lainnya
            $table->date('dob')->nullable(); // Kolom untuk tanggal lahir
            $table->string('city', 100)->nullable(); // Kolom untuk kota, menggantikan country, bisa kosong, maksimal 100 karakter

            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users'); // Hapus tabel users jika rollback
    }
};
