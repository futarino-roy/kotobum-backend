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
        Schema::create('torisetsus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('good_at');
            $table->string('weak_point');
            $table->string('recommendation');
            $table->string('landmine');
            $table->string('when_depressed')->nullable()->default(null);;
            $table->string('when_sick')->nullable()->default(null);;
            $table->string('for_making_up')->nullable()->default(null);;
            $table->string('when_bad_mood')->nullable()->default(null);;
            $table->unsignedTinyInteger('illust_choice');
            $table->string('image_url')->nullable()->default(null);
            $table->string('image_stored_path')->nullable()->default(null);
            $table->datetime('image_deleted_at')->nullable()->default(null);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torisetsus');
    }
};
