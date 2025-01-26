<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

return new class extends Migration  
{  
    public function up()  
    {  
        Schema::create('rewards', function (Blueprint $table) {  
            $table->id();  
            $table->string('nama_reward', 255)->default('Nama Reward'); // Nilai default
            $table->text('deskripsi')->nullable();  
            $table->integer('poin_dibutuhkan');  
            $table->integer('stok');  
            $table->string('kategori', 50);  
            $table->timestamps();    
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('rewards');  
    }  
};