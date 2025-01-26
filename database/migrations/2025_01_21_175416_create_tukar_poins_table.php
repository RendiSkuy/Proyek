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
        Schema::create('tukar_poins', function (Blueprint $table) {  
            $table->id(); 
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade'); // Relasi ke tabel nasabahs 
            $table->foreignId('reward_id')->constrained('rewards')->onDelete('cascade'); // Pastikan ini merujuk ke tabel rewards  
            $table->integer('jumlah');  
            $table->enum('status', ['Pending', 'On Proses', 'Diterima']);  
            $table->timestamp('tanggal_tukar');  
            $table->timestamps();  
        });
    }  

    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('tukar_poins');  
    }  
};