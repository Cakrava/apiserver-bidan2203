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
        Schema::create('tbObat', function (Blueprint $table) {
            $table->char('idObat', 7)->primary();
            $table->string('namaObat', 100);
            $table->integer('stok', 5);
            $table->string('caraPakai', 100);
            $table->double('hargaObat');


            // Adjust the length as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbObat');
    }
};
