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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_description')->nullable();
            $table->float('product_price');
            $table->integer('product_stock');
            $table->float('product_rating');
            $table->string('product_feedback')->nullable();
            $table->string('product_image');
            $table->string('product_review')->nullable();
            $table->string('product_banner');
            $table->boolean('is_done')->default(false);
            
            // Adding the foreign key column
            $table->foreignId('category_id')->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
