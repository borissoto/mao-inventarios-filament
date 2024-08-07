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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id')->nullable();
            $table->foreign('income_id')->references('id')->on('incomes');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->decimal('quantity')->nullable();
            $table->decimal('pieces')->nullable();
            $table->decimal('total_pieces')->nullable();
            $table->decimal('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('item_no')->nullable();
            // in or out
            $table->boolean('income')->nullable();
            //dispatch
            $table->decimal('quantity_out')->nullable();
            $table->timestamp('date')->nullable();
            //product's cost values
            $table->timestamp('expiration_date')->nullable();
            $table->decimal('box_cost')->nullable();
            $table->decimal('minimum_cost')->nullable();
            $table->decimal('profit_percentage')->nullable();
            $table->decimal('total_cost')->nullable();
            $table->decimal('unit_cost')->nullable();
            $table->decimal('int_custom_cost')->nullable();
            $table->decimal('national_custom_cost')->nullable();
            $table->decimal('int_trans_cost')->nullable();
            $table->decimal('national_trans_cost')->nullable();
            $table->decimal('container_cost')->nullable();
            $table->decimal('source_cost')->nullable();
            $table->decimal('sell_price')->nullable();
            $table->decimal('box_price')->nullable();
            $table->decimal('wholesale_price')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
