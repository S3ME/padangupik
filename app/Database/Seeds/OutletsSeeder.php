<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\OutletsModel;

class OutletsSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar'];
        $data = [];

        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'id'                => $i,
                'name'              => "Outlet $i",
                'address'           => "Jl. Example No. $i",
                'phone'             => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'operational_hours' => '08:00 - 22:00',
                'image'             => "outlet{$i}.jpg",
                'maps'              => "https://maps.google.com/?q=-6.2$i,106.8$i",
                'category'          => $categories[($i - 1) % count($categories)],
            ];
        }

        $outletModel = new OutletsModel();
        $outletModel->insertBatch($data);
    }
}
