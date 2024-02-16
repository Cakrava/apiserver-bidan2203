<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbBidan', function (Blueprint $table) {
            $table->char('SIPB', 7)->primary();
            $table->char('SIPB', 100);
            $table->string('namaBidan', 100);
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->char('tmpLahir', 100);
            $table->date('tglLahir');
            $table->char('alamatPraktik', 100);
    
            $table->char('nohpBidan', 20);
            $table->char('status', 100);
            $table->char('catatan', 220);
            $table->char('fotoBidan', 220);
            // Adjust the length as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbBidan');
    }
};
