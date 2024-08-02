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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kotobamu_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_approved')->nullable()->default(null); // nullなら申請中,trueなら承認,falseなら否認
            $table->string('input_keyword');
            $table->string('memo')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('kotobamu_id')->references('id')->on('kotobamus')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
