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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->cascadeOnDelete();
            $table->string('airline');
            $table->string('flight_number');
            $table->string('departure_city')->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->string('transit_city')->nullable();
            $table->timestamp('transit_time')->nullable();
            $table->string('arrival_city')->nullable();
            $table->timestamp('arrival_time')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
