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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("line_picture_url")->nullable()->default(null);
            $table->string("line_display_name")->nullable()->default(null);
            $table->string("line_user_id")->unique()->nullable()->default(null);
            $table->string('line_access_token', 255)->nullable()->default(null);
            $table->datetime('line_access_token_expired')->nullable()->default(null);
            $table->string("name")->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
