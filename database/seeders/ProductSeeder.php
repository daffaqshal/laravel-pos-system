<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'product_code' => 'BRG001',
                'name' => 'Indomie Goreng',
                'expired_date' => '2026-12-31',
                'stock' => 100,
                'price' => 3500,
            ],
            [
                'product_code' => 'BRG002',
                'name' => 'Aqua 600ml',
                'expired_date' => '2027-05-10',
                'stock' => 80,
                'price' => 4000,
            ],
            [
                'product_code' => 'BRG003',
                'name' => 'Teh Botol Sosro',
                'expired_date' => '2027-08-15',
                'stock' => 65,
                'price' => 5500,
            ],
            [
                'product_code' => 'BRG004',
                'name' => 'Beras Ramos 5 Kg',
                'expired_date' => null,
                'stock' => 40,
                'price' => 78000,
            ],
            [
                'product_code' => 'BRG005',
                'name' => 'Minyak Goreng 2L',
                'expired_date' => '2027-10-01',
                'stock' => 35,
                'price' => 39000,
            ],
            [
                'product_code' => 'BRG006',
                'name' => 'Gula Pasir 1 Kg',
                'expired_date' => null,
                'stock' => 90,
                'price' => 18000,
            ],
            [
                'product_code' => 'BRG007',
                'name' => 'Kopi Kapal Api',
                'expired_date' => '2027-09-01',
                'stock' => 70,
                'price' => 15000,
            ],
            [
                'product_code' => 'BRG008',
                'name' => 'Sabun Lifebuoy',
                'expired_date' => '2028-01-15',
                'stock' => 120,
                'price' => 8500,
            ],
            [
                'product_code' => 'BRG009',
                'name' => 'Shampo Sunsilk',
                'expired_date' => '2028-03-20',
                'stock' => 60,
                'price' => 27000,
            ],
            [
                'product_code' => 'BRG010',
                'name' => 'Pasta Gigi Pepsodent',
                'expired_date' => '2028-02-10',
                'stock' => 55,
                'price' => 14000,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}