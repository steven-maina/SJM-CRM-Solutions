<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Vendors = [
            'Medics' => 'Vendor - Medics',
            'SoftNet' => 'Vendor - SoftNet',
            'NETSolve' => 'Vendor - NETSolve',
            'Compltd' => 'Vendor - Compltd',
            'Prnitersgit' => 'Vendor - Prnitersgit',
            'Guru-ke' => 'Vendor - Guru-ke',
            'CompTec' => 'Vendor - CompTec',
            'WifiTech' => 'Vendor - WifiTech',
            'ShweizTech' => 'Vendor - ShweizTech',
            'JMMHolding' => 'Vendor -JMMHolding',
            'JTL' => 'Vendor - JTL',
            'LithiumSup' => 'Vendor - LithiumSup',
            'JOPhillips Ltd' => 'Vendor - JOPhillips',
            'Constructors Ltd' => 'Vendor - Constructors Ltd',
            'Hospital Z' => 'Vendor - Hospital Z',
        ];
        foreach ($Vendors as $name => $VendorName) {
            DB::table('Vendors')->insert([
                'VendorID' => 'VEN-' . str_pad($this->getNextVendorCode(), 4, '0', STR_PAD_LEFT),
                'VendorName' => $VendorName,
                'email' => strtolower(str_replace(' ', '', $VendorName)) . '@example.com',
                'MobileNo' => '1234567890', // Replace this with the actual mobile number.
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getNextVendorCode()
    {
        $latestVendor = DB::table('Vendors')->latest('VendorID')->first();
        if ($latestVendor) {
            $lastCode = substr($latestVendor->VendorID, 4);
            return (int) $lastCode + 1;
        } else {
            return 1;
        }
    }
}
