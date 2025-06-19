<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\GalleriesModel;

class GalleriesSeeder extends Seeder
{
    public function run()
    {
        $now        = date('Y-m-d H:i:s');
        $images     = ['dummy-1.jpg', 'dummy-2.jpg', 'dummy-3.jpg', 'dummy-4.jpg', 'dummy-5.jpg'];
        $data       = [];

        for ($i = 1; $i <= 40; $i++) {
            $data[] = [
                'id'            => $i,
                'image'         => $images[($i - 1) % count($images)],
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }

        $galleriesModel = new GalleriesModel();
        $galleriesModel->insertBatch($data);
    }
}
