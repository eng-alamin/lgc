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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->string('serial');
            $table->string('number');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('counselor_id')->nullable()->constrained();
            $table->foreignId('agent_id')->nullable()->constrained();
            $table->string('type'); //Education, Medical, Business, Travel, Job
            $table->json('data')->nullable();
            $table->enum('status',['pending', 'processing', 'approved', 'cancelled'])->default('pending');
            $table->text('note')->nullable(); //rejection reason / comment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
