<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAlbumsTable extends Migration
{
    public function up(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->string('cover')->nullable()->after('user_id');
            $table->text('body')->nullable()->after('cover');
            $table->boolean('is_sent')->default(false)->after('body');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'cover', 'body', 'is_sent']);
        });
    }
}

