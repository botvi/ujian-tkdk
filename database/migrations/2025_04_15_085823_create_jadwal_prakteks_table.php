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
        Schema::create('jadwal_prakteks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('penguji_id');
            $table->foreignId('gelombang_id');
            $table->foreignId('tahun_akademik_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penguji_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gelombang_id')->references('id')->on('master_gelombangs')->onDelete('cascade');
            $table->foreign('tahun_akademik_id')->references('id')->on('master_tahun_akademiks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_prakteks');
    }
};
