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
            Schema::create('customers', function (Blueprint $table) {
                $table->id('Detailid');
                $table->string('CustomerID')->unique();
                $table->string('CustomerName');
                $table->string('email');
                $table->string('MobileNo');
                $table->timestamps();
                  });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
