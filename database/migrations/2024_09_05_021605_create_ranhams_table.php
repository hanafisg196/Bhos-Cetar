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
            $table->string('user_id');
            $table->string('name');
            $table->tinyInteger('read')->default(0);
            $table->unsignedBigInteger('kkp_id');
            $table->string('status')->default('Usulan');
            $table->string('message')->default('-');
            $table->unsignedBigInteger('catran_id')->nullable();
            $table->timestamps();
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
