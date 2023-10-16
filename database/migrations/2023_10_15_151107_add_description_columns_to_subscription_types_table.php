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
          Schema::table('subscription_types', function (Blueprint $table) {
           $table->string('description')->nullable();
           $table->string('feature1')->nullable();
           $table->string('feature2')->nullable();
           $table->string('feature3')->nullable();
           $table->string('feature4')->nullable();
           $table->string('feature5')->nullable();
           $table->string('feature6')->nullable();
           $table->string('feature7')->nullable();
           $table->string('feature8')->nullable();
           $table->string('feature9')->nullable();
           $table->string('feature10')->nullable();
           $table->string('feature11')->nullable();
           $table->string('feature12')->nullable();
           $table->string('feature13')->nullable();
           $table->string('feature14')->nullable();
           $table->string('feature15')->nullable();
           });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('subscription_types', function (Blueprint $table) {
      });
    }
};
