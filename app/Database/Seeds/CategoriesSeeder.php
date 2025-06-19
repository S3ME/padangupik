<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CategoriesModel;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Rendang'],
            ['id' => 2, 'name' => 'Ayam'],
            ['id' => 3, 'name' => 'Ikan'],
            ['id' => 4, 'name' => 'Sayur'],
            ['id' => 5, 'name' => 'Gorengan'],
            ['id' => 6, 'name' => 'Sambal'],
            ['id' => 7, 'name' => 'Minuman'],
            ['id' => 8, 'name' => 'Lauk Pauk'],
        ];

        $model = new CategoriesModel();
        $model->insertBatch($data);
    }
}
