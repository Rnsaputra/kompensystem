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
        Schema::create('kompensasis', function (Blueprint $table) {
            $table->id();

            // KEMBALI KE MAHASISWA_ID
            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswas')
                ->onDelete('cascade')
                ->unique(); // 1 Mahasiswa = 1 Data Kompen

            $table->integer('jumlah_alpha');
            $table->integer('pengali')->default(2);
            $table->integer('total_kompensasi');
            $table->enum('status', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->json('completed_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompensasis');
    }
};
