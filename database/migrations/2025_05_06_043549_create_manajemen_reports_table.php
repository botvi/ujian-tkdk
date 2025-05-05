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
        Schema::create('manajemen_reports', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rektor');
            $table->string('nidn_rektor')->nullable();
            $table->string('ttd_rektor')->nullable();
            $table->string('nama_ketua_lppmdi');
            $table->string('nidn_ketua_lppmdi')->nullable();
            $table->string('ttd_ketua_lppmdi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_reports');
    }
};
