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
            //
            $table->dropUnique(['email']);
            $table->renameColumn('email', 'login_id');
            $table->unique('login_id');
            $table->dropColumn(['email_verified_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropUnique(['login_id']);
            $table->renameColumn('login_id', 'email');
            $table->unique('email');
            $table->timestamp('email_verified_at')->nullable();
        });
    }
};
