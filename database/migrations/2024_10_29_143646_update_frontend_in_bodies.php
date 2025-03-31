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
            //
            $table->dropColumn([
                'htmlContent',
                'cssContent',
                'cssUrls',
                'localStorageData',
                'newImageDatabase1Data',
                'imageDBData'
            ]);

            $table->json('textData');
            $table->json('imageData');
            $table->json('colors');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bodies', function (Blueprint $table) {
            // 新しく追加したカラムを削除
            $table->dropColumn([
                'textData',
                'imageData',
                'colors',
            ]);
    
            // 削除した元のカラムを再追加
            $table->longText('htmlContent')->nullable();
            $table->longText('cssContent')->nullable();
            $table->JSON('cssUrls')->nullable();
            $table->JSON('localStorageData')->nullable();
            $table->JSON('newImageDatabase1Data')->nullable();
            $table->JSON('imageDBData')->nullable();
        });
    }
};
