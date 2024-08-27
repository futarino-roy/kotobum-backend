<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->longText('cover')->nullable()->change();
            $table->longText('body')->nullable()->change();
            $table->unsignedBigInteger('user_id')->after('body');
            $table->boolean('is_sent')->default(false)->after('user_id');
            
            // 外部キー制約を追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->text('cover')->nullable()->change();
            $table->text('body')->nullable()->change();
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'is_sent']);
        });
    }
};
