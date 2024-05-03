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
        Schema::create('video_trending', function (Blueprint $table) {
            $table->id();
            // Adding the foreign key column
            $table->foreignId('category_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->string('video_title1');
            $table->string('video1');
            $table->string('video_title2')->nullable();
            $table->string('video2')->nullable();
            $table->string('video_title3')->nullable();
            $table->string('video3')->nullable();
            $table->string('video_title4')->nullable();
            $table->string('video4')->nullable();
            $table->string('video_title5')->nullable();
            $table->string('video5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_trending');
    }
};
