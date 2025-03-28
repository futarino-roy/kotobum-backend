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
        Schema::table('covers', function (Blueprint $table) {
            // 間違った外部キー制約を削除
            $table->dropForeign(['albums_id']);

            // 正しい外部キー制約を追加
            $table->foreign('albums_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('covers', function (Blueprint $table) {
            // 修正を元に戻す（誤った制約を再追加）
            $table->dropForeign(['albums_id']);
            $table->foreign('albums_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
