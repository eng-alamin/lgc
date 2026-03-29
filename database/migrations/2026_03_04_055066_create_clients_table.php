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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('counselor_id')->nullable()->constrained();
            $table->foreignId('agent_id')->nullable()->constrained();
            $table->string('service')->nullable(); //Education, Medical, Business, Travel, Job
            $table->json('data')->nullable();
            $table->int('profile_completion')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    //personals - name,email,phone,gender, date_of_birth, nationality, marital_status, blood_group, religion, address 
    //academics - degree, institution, year, grade
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
