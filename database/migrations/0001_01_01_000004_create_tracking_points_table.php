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
        Schema::create('tracking_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lbh_id')->nullable();
            $table->unsignedBigInteger('lah_id')->nullable();
            $table->unsignedBigInteger('ecor_id')->nullable();
            $table->string('status');
            $table->string('nama_pemohon')->nullable();
            $table->string('nama_pemeriksa')->nullable();
            $table->string('nama_kabag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_points');
    }
};
