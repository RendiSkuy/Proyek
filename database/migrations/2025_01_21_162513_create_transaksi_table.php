<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade'); // Relasi ke nasabah
            $table->string('kode_transaksi')->unique(); // Kode unik transaksi
            $table->date('tanggal'); // Tanggal transaksi
            $table->decimal('total_berat', 8, 2); // Total berat sampah (Kg)
            $table->decimal('total_harga', 15, 2); // Total harga transaksi (Rp)
            $table->integer('total_poin'); // Total poin yang diperoleh
            $table->text('keterangan')->nullable(); // Keterangan transaksi
            $table->enum('status', ['sedang di proses', 'selesai'])->default('sedang di proses'); // Status transaksi
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
