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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('forename')->nullable();
            $table->string('p_surname')->nullable();
            $table->string('m_surname')->nullable();
            $table->string('id_number')->nullable();
            $table->string('sex')->nullable();
            $table->datetime('birthdate')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('start')->nullable();
            $table->integer('status')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
