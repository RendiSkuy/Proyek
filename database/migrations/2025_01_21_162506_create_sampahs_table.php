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
        Schema::create('sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sampah_id')
                ->constrained('kategori_sampah')
                ->onDelete('cascade');
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_kg', 15, 2);
            $table->decimal('poin_per_kg', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampah');
    }
};
