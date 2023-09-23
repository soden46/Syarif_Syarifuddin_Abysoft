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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->bigInteger('nomor_ktp');
            $table->text('alamat');
            $table->string('kecamatan', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);
            $table->string('pekerjaan', 50);
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('gol_darah', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
