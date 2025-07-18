<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sampahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sampah_id')->constrained('kategori_sampahs')->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('harga_per_kg');
            $table->integer('poin_per_kg');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sampahs');
    }
};

