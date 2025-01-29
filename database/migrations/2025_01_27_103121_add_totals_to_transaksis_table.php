<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('transaksis', function (Blueprint $table) {
        if (!Schema::hasColumn('transaksis', 'total_berat')) {
            $table->decimal('total_berat', 8, 2)->default(0)->after('tanggal');
        }

        if (!Schema::hasColumn('transaksis', 'total_harga')) {
            $table->decimal('total_harga', 15, 2)->default(0)->after('total_berat');
        }

        if (!Schema::hasColumn('transaksis', 'total_poin')) {
            $table->integer('total_poin')->default(0)->after('total_harga');
        }
    });
}

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['total_berat', 'total_harga', 'total_poin']);
        });
    }
};
