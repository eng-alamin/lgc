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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('password');
            $table->enum('type', ['user', 'agent', 'admin', 'super_admin'])->default('user')->after('avatar');
            $table->json('data')->nullable()->after('type');
            $table->boolean('toc')->default(false)->after('data');
            $table->string('last_login_ip')->nullable()->after('toc');
            $table->timestamp('last_seen')->nullable()->after('last_login_ip');
            $table->tinyInteger('account_status')->default(0)->comment('0=pending,1=approved,2=deactive,3=suspended,4=banned,5=deleted')->after('last_seen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
