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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('employee_id')->unique(); // LG-EMP-001
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('designation');
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->decimal('allowance', 10, 2)->default(0);
            $table->date('join_date');
            $table->enum('employment_type', ['full_time','part_time','contract'])->default('full_time');
            $table->enum('status', ['active','inactive','suspended'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
