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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('room_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('check_in_date');
            $table->string('check_out_date');
            $table->integer('total_price');
            $table->enum('status', ['confirmed', 'pending', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
