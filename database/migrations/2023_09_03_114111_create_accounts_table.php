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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
          $table->string('name');
          $table->string('logo', 2048)->nullable();
          $table->string('city')->nullable();
          $table->string('address')->nullable();
          $table->string('subscription_id')->nullable();
          $table->geometry('positions')->nullable();
          $table->integer('created_by')->nullable();
          $table->integer('updated_by')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
