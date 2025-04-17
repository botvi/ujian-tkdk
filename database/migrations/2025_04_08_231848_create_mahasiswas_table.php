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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('npm');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('no_wa');
            $table->foreignId('gelombang_id');
            $table->foreignId('tahun_akademik_id');
            $table->string('status_akun')->default('nonaktif');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gelombang_id')->references('id')->on('master_gelombangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tahun_akademik_id')->references('id')->on('master_tahun_akademiks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
