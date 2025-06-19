<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProductsModel;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'name'        => 'Rendang',
                'description' => 'Daging sapi yang dimasak dengan bumbu khas Padang.',
                'favorite'    => 1,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Ayam Penyet',
                'description' => 'Ayam goreng yang disajikan dengan sambal dan lalapan.',
                'favorite'    => 0,
                'category_id' => 2,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Sate Padang',
                'description' => 'Sate daging sapi dengan kuah kental khas Padang.',
                'favorite'    => 1,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Dendeng Balado',
                'description' => 'Dendeng sapi tipis dengan sambal balado pedas.',
                'favorite'    => 0,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Gulai Ayam',
                'description' => 'Ayam dimasak dengan kuah santan dan rempah.',
                'favorite'    => 1,
                'category_id' => 2,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Ikan Bakar',
                'description' => 'Ikan bakar dengan bumbu khas Minang.',
                'favorite'    => 0,
                'category_id' => 3,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Soto Padang',
                'description' => 'Soto daging sapi dengan bihun dan kerupuk.',
                'favorite'    => 1,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Ayam Pop',
                'description' => 'Ayam goreng putih khas Padang.',
                'favorite'    => 0,
                'category_id' => 2,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Gulai Tunjang',
                'description' => 'Gulai kikil sapi dengan kuah santan.',
                'favorite'    => 1,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Perkedel Kentang',
                'description' => 'Perkedel kentang goreng renyah.',
                'favorite'    => 0,
                'category_id' => 4,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Telur Balado',
                'description' => 'Telur rebus dengan sambal balado.',
                'favorite'    => 1,
                'category_id' => 4,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Gulai Cumi',
                'description' => 'Cumi-cumi dimasak dengan kuah santan pedas.',
                'favorite'    => 0,
                'category_id' => 3,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Sambalado Tanak',
                'description' => 'Sambal khas Minang dengan teri dan petai.',
                'favorite'    => 1,
                'category_id' => 4,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Gulai Daun Singkong',
                'description' => 'Daun singkong dengan kuah santan.',
                'favorite'    => 0,
                'category_id' => 4,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Ikan Asam Padeh',
                'description' => 'Ikan dimasak dengan kuah asam pedas.',
                'favorite'    => 1,
                'category_id' => 3,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Paru Goreng',
                'description' => 'Paru sapi goreng renyah.',
                'favorite'    => 0,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Gulai Otak',
                'description' => 'Otak sapi dimasak dengan kuah santan.',
                'favorite'    => 1,
                'category_id' => 1,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Sayur Nangka',
                'description' => 'Sayur nangka muda dengan kuah santan.',
                'favorite'    => 0,
                'category_id' => 4,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Ayam Bakar',
                'description' => 'Ayam bakar bumbu khas Minang.',
                'favorite'    => 1,
                'category_id' => 2,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Gulai Kepala Ikan',
                'description' => 'Kepala ikan dimasak dengan kuah santan pedas.',
                'favorite'    => 0,
                'category_id' => 3,
                'image'       => '2.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        $model = new ProductsModel();
        $model->insertBatch($data);
    }
}
