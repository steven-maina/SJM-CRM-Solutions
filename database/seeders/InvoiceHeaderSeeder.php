<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class InvoiceHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $customers = DB::table('Customers')->get();

        for ($i = 1; $i <= 200; $i++) {
            $customer = $customers->random();
            $amountNetOfTax = $faker->numberBetween(1000, 1000000);
            $taxAmount = $amountNetOfTax * 0.16;
            $totalAmount = $amountNetOfTax + $taxAmount;

            DB::table('Invoice_Header')->insert([
                'InvoiceNo' => 'INV-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'CustomerID' => $customer->CustomerID,
                'CustomerName' => $customer->CustomerName,
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
