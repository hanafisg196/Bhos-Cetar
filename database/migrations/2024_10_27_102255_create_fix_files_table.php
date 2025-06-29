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
        Schema::create('fix_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ecor_id');
            $table->string('file');
            $table->timestamps();

            $table->foreign('ecor_id')->references('id')->on('ecorrections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fix_files');
    }
};
