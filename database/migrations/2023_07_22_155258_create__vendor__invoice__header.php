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
        Schema::create('VendorInvoice_Header', function (Blueprint $table) {
                $table->id('Detailid');
                $table->string('InvoiceNo')->unique();
                $table->string('VendorID');
                $table->string('VendorName');
                $table->string('Currency');
                $table->string('InvoiceDescription');
                $table->string('InvoiceReference');
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
        Schema::dropIfExists('_vendor__invoice__header');
    }
};
