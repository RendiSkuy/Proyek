<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('poins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');
            $table->string('nama_poin');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah')->default(0);
            $table->enum('kategori', ['organik', 'anorganik', 'elektronik', 'lainnya']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poins');
    }
};