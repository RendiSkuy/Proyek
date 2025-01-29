<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->string('kode_transaksi')->unique();
            $table->date('tanggal');
            $table->decimal('total_berat', 8, 2)->default(0);
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->integer('total_poin')->default(0);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['sedang di proses', 'selesai'])->default('sedang di proses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
