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
        Schema::create('kategori_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // Nama kategori sampah
            $table->text('deskripsi')->nullable(); // Deskripsi kategori sampah
            $table->enum('jenis', ['organik', 'anorganik', 'lainnya']); // Jenis sampah
            $table->decimal('poin_per_kg', 10, 2); // Poin per kilogram sampah
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_sampah');
    }
};
