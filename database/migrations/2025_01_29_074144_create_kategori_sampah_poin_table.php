<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kategori_sampah_poin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poin_id')->constrained('poins')->onDelete('cascade');
            $table->foreignId('kategori_sampah_id')->constrained('kategori_sampahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_sampah_poin');
    }
};




