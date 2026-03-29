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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('form_id')->constrained('forms')->cascadeOnDelete();
            $table->foreignId('assign_id')->constrained('users')->cascadeOnDelete();
            $table->date('follow_up_date');
            $table->enum('status',['pending','done'])->default('pending');
            $table->string('priority')->default('normal'); // normal / high / urgent
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
