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
      Schema::table('users', function (Blueprint $table) {
        $table->string('address')->nullable();
        $table->string('country')->nullable();
        $table->string('city')->nullable();
        $table->date('dob')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('address');
        $table->dropColumn('country');
        $table->dropColumn('city');
        $table->dropColumn('dob');
      });
    }
};
