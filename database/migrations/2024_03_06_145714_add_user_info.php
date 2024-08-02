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
            $table->date('birthday')->nullable()->default(null)->after('name');
            $table->tinyInteger('pref')->nullable()->default(null)->after('name');
            $table->tinyInteger('state')->nullable()->default(null)->after('name');
            $table->tinyInteger('gender')->nullable()->default(null)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('pref');
            $table->dropColumn('state');
            $table->dropColumn('gender');
        });
    }
};
