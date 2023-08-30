<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $invoices = DB::table('Invoice_Header')->get();

        foreach ($invoices as $invoice) {
            $amountNetOfTax = $invoice->Amount_NetofTax;
            $taxAmount = $invoice->TaxAmount;
            $totalAmount = $invoice->TotalAmount;

            // Calculate 80% and 20% of Amount_NetofTax, TaxAmount, and TotalAmount
            $amount80Percent = $amountNetOfTax * 0.8;
            $tax80Percent = $taxAmount * 0.8;
            $total80Percent = $totalAmount * 0.8;

            $amount20Percent = $amountNetOfTax * 0.2;
            $tax20Percent = $taxAmount * 0.2;
            $total20Percent = $totalAmount * 0.2;

            // Insert first line (Software Purchase - 80% of Amount_NetofTax, TaxAmount, and TotalAmount)
            DB::table('Invoice_Details')->insert([
                'InvoiceNo' => $invoice->InvoiceNo,
                'CustomerID' => $invoice->CustomerID,
                'DetailDescription' => 'Software Purchase',
                'Amount_NetofTax' => $amount80Percent,
                'TaxAmount' => $tax80Percent,
                'TotalAmount' => $total80Percent,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert second line (Maintenance Fee - 20% of Amount_NetofTax, TaxAmount, and TotalAmount)
            DB::table('Invoice_Details')->insert([
                'InvoiceNo' => $invoice->InvoiceNo,
                'CustomerID' => $invoice->CustomerID,
                'DetailDescription' => 'Maintenance Fee',
                'Amount_NetofTax' => $amount20Percent,
                'TaxAmount' => $tax20Percent,
                'TotalAmount' => $total20Percent,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
