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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nip');
            $table->string('nama');
            $table->string('alamat');
            $table->string('email');
            $table->string('wa');
            $table->text('kronologi');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('read')->default(0);
            $table->string('status')->default('Usulan');
            $table->string('message')->default('-');
            $table->string('special_message')->nullable();
            $table->string('verifikator_nip')->nullable();
            $table->string('verifikator_name')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
