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
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Relasi ke users
            $table->string('nama'); // Nama nasabah
            $table->string('email')->nullable()->change();// Email unik
            $table->string('password'); // Password terenkripsi
            $table->text('alamat')->nullable(); // Alamat (opsional)
            $table->string('telepon')->nullable(); // Nomor telepon (opsional)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status nasabah
            $table->timestamps(); // Kolom created_at dan updated_at// Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
        
    }
};
