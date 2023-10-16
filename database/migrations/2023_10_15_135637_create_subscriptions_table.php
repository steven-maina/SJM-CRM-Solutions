<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('code');
          $table->unsignedBigInteger('account_id');
          $table->decimal('price', 8, 2);
          $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('end_date')->nullable();
          $table->foreign('account_id')->references('id')->on('accounts');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
