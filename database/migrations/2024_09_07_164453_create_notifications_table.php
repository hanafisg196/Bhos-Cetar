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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lbh_id')->nullable();
            $table->unsignedBigInteger('lah_id')->nullable();
            $table->tinyInteger('notif_read')->default(0);
            $table->timestamps();

        $table->foreign('lbh_id')->references('id')->on('schedules')->onDelete('set null');
        $table->foreign('lah_id')->references('id')->on('ranhams')->onDelete('set null');
        $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
