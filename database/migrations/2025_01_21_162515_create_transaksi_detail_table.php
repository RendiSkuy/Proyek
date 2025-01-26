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
        if (!Schema::hasTable('transaksi_details')) {  
            Schema::create('transaksi_details', function (Blueprint $table) {  
                $table->id();  
                $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade'); // Relasi ke tabel transaksis  
                $table->foreignId('sampah_id')->constrained('sampah')->onDelete('cascade'); // Ubah 'sampahs' menjadi 'sampah'  
                $table->decimal('berat', 8, 2); // Berat sampah dalam Kg  
                $table->decimal('harga_per_kg', 15, 2); // Harga per Kg dalam Rupiah  
                $table->decimal('subtotal', 15, 2); // Subtotal transaksi (berat * harga per kg)  
                $table->integer('poin')->nullable(); // Poin yang diperoleh  
                $table->timestamps(); // created_at dan updated_at  
            });  
        }  
    }  

    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('transaksi_details');  
    }  
};