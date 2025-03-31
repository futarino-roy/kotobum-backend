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
        Schema::table('bodies', function (Blueprint $table) {
            // 既存のtextカラムをlongtextに変更
            $table->longText('htmlContent')->nullable()->change();
            $table->longText('cssContent')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bodies', function (Blueprint $table) {
            // longtextを元のtextに戻す
            $table->text('htmlContent')->nullable()->change();
            $table->text('cssContent')->nullable()->change();
        });
    }
};
