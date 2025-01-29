<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('poins', function (Blueprint $table) {
            $table->integer('jumlah')->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        Schema::table('poins', function (Blueprint $table) {
            $table->integer('jumlah')->default(0)->change();
        });
    }
};
