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
            $table->string('product_name')->unique();
            $table->string('product_brand');
            $table->string('product_description',500)->nullable();
            $table->float('product_price');
            $table->integer('product_stock');
            $table->float('product_rating')->nullable();
            $table->string('product_feedback')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_review')->nullable();
            $table->string('product_banner')->nullable();
            $table->boolean('is_done')->default(false);
            
            $table->foreignId('category_id')->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

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