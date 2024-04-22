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
        Schema::create('user_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained()
            ->onDelete('cascade');
            $table->integer('product_id')->constrained()
            ->onDelete('cascade');
            
            $table->string('card_number');
            $table->string('card_holder_name');
            $table->string('expiration_date');
            $table->string('cvv');
            $table->double('total_price');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payment');
    }
};
