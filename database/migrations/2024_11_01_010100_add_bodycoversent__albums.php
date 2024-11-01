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
        Schema::table('albums', function (Blueprint $table) {
            //校了済み属性をボディとカバーそれぞれ設定する
            $table->renameColumn('is_sent', 'body_is_sent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            //
            $table->renameColumn('body_is_sent', 'is_sent');
        });
    }
};
