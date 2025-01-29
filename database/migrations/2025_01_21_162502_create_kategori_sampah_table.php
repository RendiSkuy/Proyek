<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kategori_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('jenis', ['organik', 'anorganik', 'lainnya']);
            $table->integer('poin_per_kg');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_sampahs');
    }
};

