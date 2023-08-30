<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VendorInvoiceHeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $vendors = DB::table('Vendors')->get();

        for ($i = 1; $i <= 200; $i++) {
            $vendor = $vendors->random();
            $amountNetOfTax = $faker->numberBetween(500, 500000);
            $taxAmount = $amountNetOfTax * 0.16;
            $totalAmount = $amountNetOfTax + $taxAmount;

            DB::table('VendorInvoice_Header')->insert([
                'InvoiceNo' => 'INV-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'VendorID' => $vendor->VendorID,
                'VendorName' => $vendor->VendorName,
                'Currency' => 'KES',
                'InvoiceDescription' => 'Service Offered',
                'InvoiceReference' => 'Ref NO',
                'Amount_NetofTax' => $amountNetOfTax,
                'TaxAmount' => $taxAmount,
                'TotalAmount' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
