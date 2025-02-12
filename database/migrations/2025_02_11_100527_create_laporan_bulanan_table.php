<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_bulanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->date('bulan');  // Tetap gunakan DATE
            $table->decimal('total_berat', 10, 2)->default(0);
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->integer('total_poin')->default(0);
            $table->decimal('keuntungan_bank', 15, 2)->default(0); // Keuntungan Bank
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_bulanans');
    }
};
