<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'supplier_number' => 'SUP001',
                'pic_name' => 'PT Sumber Makmur',
                'address' => 'Batam Centre, Batam',
            ],
            [
                'supplier_number' => 'SUP002',
                'pic_name' => 'CV Berkah Jaya',
                'address' => 'Nagoya, Batam',
            ],
            [
                'supplier_number' => 'SUP003',
                'pic_name' => 'PT Indo Distributor',
                'address' => 'Batu Aji, Batam',
            ],
            [
                'supplier_number' => 'SUP004',
                'pic_name' => 'CV Maju Bersama',
                'address' => 'Tiban, Batam',
            ],
            [
                'supplier_number' => 'SUP005',
                'pic_name' => 'PT Nusantara Supply',
                'address' => 'Sekupang, Batam',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}