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
        Schema::create('video_trendings', function (Blueprint $table) {
            $table->id();
            // Adding the foreign key column
            $table->foreignId('category_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->string('video_title');
            $table->string('video_link');
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
