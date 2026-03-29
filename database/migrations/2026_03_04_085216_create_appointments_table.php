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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained();
            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            $table->string('service')->nullable();  // student / business
            $table->string('type')->default('office'); // office / online
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled, no-show
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
