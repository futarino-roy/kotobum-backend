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
        Schema::create('bodies', function (Blueprint $table) {
            $table->id();
            $table->nsignedBigInteger('albums_id');
            $table->text('htmlContent')->nullable();
            $table->text('cssContent')->nullable();
            $table->JSON('cssUrls')->nullable();
            $table->JSON('localStorageData')->nullable();
            $table->JSON('newImageDatabase1Data')->nullable();
            $table->JSON('imageDBData')->nullable();
            $table->timestamps();

            $table->foreign('albums_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodies');
    }
};
