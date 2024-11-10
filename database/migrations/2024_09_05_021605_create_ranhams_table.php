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
        Schema::create('ranhams', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('link');
            $table->string('name');
            $table->string('nip');
            $table->tinyInteger('read')->default(0);
            $table->unsignedBigInteger('kkp_id');
            $table->unsignedBigInteger('user_id');
            $table->string('special_message')->nullable();
            $table->string('status')->default('Usulan');
            $table->string('message')->default('-');
            $table->unsignedBigInteger('catran_id')->nullable();
            $table->string('verifikator_nip')->nullable();
            $table->string('verifikator_name')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kkp_id')->references('id')->on('kkps');
            $table->foreign('catran_id')->on('category_ranhamns')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranhams');
    }
};
