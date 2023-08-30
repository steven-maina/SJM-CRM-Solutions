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
        Schema::create('Invoice_Details', function (Blueprint $table) {
            $table->id('Detailid');
            $table->string('InvoiceNo');
            $table->string('CustomerID');
            $table->string('DetailDescription');
            $table->decimal('Amount_NetofTax', 10, 2);
            $table->decimal('TaxAmount', 10, 2);
            $table->decimal('TotalAmount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_invoice_details');
    }
};
