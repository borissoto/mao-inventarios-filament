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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->string('name')->nullable();
            $table->string('item')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();         
            $table->decimal('stock_in')->nullable();         
            $table->decimal('stock_out')->nullable();
            $table->decimal('stock')->nullable();
            $table->decimal('sell_price')->nullable();
            $table->decimal('wholesale_price')->nullable();
            $table->decimal('box_price')->nullable();
            $table->decimal('liquidation_price')->nullable();
            $table->string('image_url')->nullable();
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
