<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            'ABZ' => 'Customer - ABZ',
            'James' => 'Customer - James',
            'Stephen' => 'Customer - Stephen',
            'Atieno' => 'Customer - Atieno',
            'Chirchir' => 'Customer - Chirchir',
            'Ahmed' => 'Customer - Ahmed',
            'Makena' => 'Customer - Makena',
            'Mutembei' => 'Customer - Mutembei',
            'Royland' => 'Customer - Royland',
            'ZA Company Ltd' => 'Customer - ZA Company Ltd',
            'Mary' => 'Customer - Mary',
            'Julius' => 'Customer - Julius',
            'JO Ltd' => 'Customer - JO Ltd',
            'Insurance Ltd' => 'Customer - Insurance Ltd',
            'Hotel A' => 'Customer - Hotel A',
        ];
        foreach ($customers as $name => $customerName) {
            DB::table('customers')->insert([
                'CustomerID' => 'CUS-' . str_pad($this->getNextCustomerCode(), 4, '0', STR_PAD_LEFT),
                'CustomerName' => $customerName,
                'email' => strtolower(str_replace(' ', '', $customerName)) . '@example.com',
                'MobileNo' => '1234567890', // Replace this with the actual mobile number.
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    private function getNextCustomerCode()
    {
        $latestCustomer = DB::table('customers')->latest('CustomerID')->first();
        if ($latestCustomer) {
            $lastCode = substr($latestCustomer->CustomerID, 4);
            return (int) $lastCode + 1;
        } else {
            return 1;
        }
    }
}
