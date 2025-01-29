<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained()->onDelete('cascade');
            $table->foreignId('sampah_id')->constrained()->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->decimal('harga', 15, 2)->nullable(); // Harga bisa null
            $table->integer('poin')->nullable(); // Poin bisa null
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
