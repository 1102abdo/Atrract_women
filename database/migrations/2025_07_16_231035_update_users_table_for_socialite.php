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
            $table->dropColumn(['email', 'name', 'email_verified_at']);

            $table->string('username')->unique()->after('id');
            $table->string('provider')->nullable()->after('password');
            $table->string('provider_id')->nullable()->after('provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

        $table->string('email')->unique()->nullable();
        $table->string('name')->nullable();
        $table->timestamp('email_verified_at')->nullable();

        $table->dropColumn(['username', 'provider', 'provider_id']);
    });
    }
};
