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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('detail')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('address')->nullable();
            $table->string('time')->nullable();
            $table->string('website')->nullable();
            $table->json('social')->nullable();
            $table->string('auth_bg_image')->nullable();
            $table->string('auth_fg_image')->nullable();
            $table->string('auth_title')->nullable();
            $table->text('auth_detail')->nullable();
            $table->string('socialite')->nullable();
            $table->json('google')->nullable();
            $table->json('facebook')->nullable();
            $table->json('smtp')->nullable();
            $table->json('protection')->nullable();
            $table->json('meta')->nullable();
            $table->json('other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
