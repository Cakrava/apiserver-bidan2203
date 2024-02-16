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
        Schema::create('tbPasien', function (Blueprint $table) {
            $table->char('noRekamMedis', 7)->primary();
            $table->char('nikPasien', 100);
            $table->string('namaPasien', 100);
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->char('tmpLahirPasien', 100);
            $table->date('tglLahirPasien');
            $table->char('alamatPasien', 100);
            $table->char('nohpPasien', 20);
            $table->date('tglPendaftaran');
            $table->char('catatan', 220);
            $table->char('fotoPasien', 220);
            $table->char('foto_thumb', 220);

            // Adjust the length as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbPasien');
    }
};
