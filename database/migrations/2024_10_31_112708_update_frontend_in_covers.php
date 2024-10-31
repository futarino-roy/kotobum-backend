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
        Schema::table('covers', function (Blueprint $table) {
            //
            $table->dropColumn([
                'textData',
                'imageData',
                'colors',
            ]);

            $table->text('htmlContent')->nullable();
            $table->text('cssContent')->nullable();
            $table->JSON('cssUrls')->nullable();
            $table->JSON('localStorageData')->nullable();
            $table->JSON('newImageDatabase1Data')->nullable();
            $table->JSON('imageDBData')->nullable();
        });
    }
};
