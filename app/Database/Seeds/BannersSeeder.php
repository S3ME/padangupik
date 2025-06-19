<?php

namespace App\Database\Seeds;

use App\Models\BannersModel;
use CodeIgniter\Database\Seeder;

class BannersSeeder extends Seeder
{
    public function run()
    {
        $now        = date('Y-m-d H:i:s');
        $images     = ['eat.webp', 'grand-opening.webp', 'yum-yum.webp'];
        $data       = [];

        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'id'            => $i,
                'image'         => $images[($i - 1) % count($images)],
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }

        $BannersModel = new BannersModel();
        $BannersModel->insertBatch($data);
    }
}
