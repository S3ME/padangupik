<?php

namespace App\Controllers;
use App\Models\GalleriesModel;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;
use App\Models\BannersModel;

class Home extends BaseController
{
    public function index(): string
    {
        // Calling Models
        $ProductsModel      = new ProductsModel();
        $CategoriesModel    = new CategoriesModel();
        $BannersModel       = new BannersModel();

        // Populating Data
        $newproducts        = $ProductsModel->orderBy('id', 'DESC')->limit(2)->find();
        $favproducts        = $ProductsModel->orderBy('id', 'DESC')->where('favorite', 1)->limit(2)->find();
        $categories         = $CategoriesModel->findAll();
        $banners            = $BannersModel->findAll();

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik';
        $data['description']    = 'Warung Padang Upik LAUK HARI INI TIDAK DIJUAL ESOK #LaukLaluBiarlahBerlalu, menyajikan masakan Padang autentik dengan cita rasa khas, lauk segar setiap hari, dan harga terjangkau. Nikmati pengalaman makan terbaik di Padang Upik, pilihan tepat untuk pecinta kuliner Minang.';
        $data['keywords']       = 'padang, upik, rumah makan, kuliner, minang, sumatera barat, masakan padang, lauk segar, makanan tradisional, nasi padang';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url();
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['newproducts']    = $newproducts;
        $data['favproducts']    = $favproducts;
        $data['categories']     = $categories;
        $data['banners']        = $banners;

        // Rendering View
        return view('frontoffice/home', $data);
    }

    public function about(): string
    {
        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Tentang Kami - Warung Padang Upik';
        $data['description']    = 'Pelajari lebih lanjut tentang Warung Padang Upik, sejarah, visi, dan misi kami dalam menyajikan masakan Padang yang lezat dan berkualitas.';
        $data['keywords']       = 'tentang kami, warung padang upik, sejarah, visi, misi, masakan padang';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('about');
        $data['image']          = base_url('favicon/android-icon-192x192.png');

        // Rendering View
        return view('frontoffice/about', $data);
    }

    public function gallery(): string
    {
        // Calling Models
        $GalleriesModel         = new GalleriesModel();

        // Populating Data
        $galleries              = $GalleriesModel->orderBy('id', 'DESC')->paginate(20, 'galleries');

        // // Validating Data
        // if (!$galleries) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Galeri Tidak Ditemukan');
        // }

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['galleries']      = $galleries;
        $data['title']          = 'Galeri Foto - Warung Padang Upik';
        $data['description']    = 'Jelajahi galeri foto Warung Padang Upik yang menampilkan suasana restoran, kelezatan masakan Padang, serta aktivitas dan momen spesial pelanggan kami.';
        $data['keywords']       = 'galeri foto warung padang upik, masakan padang, restoran padang, suasana warung, makanan khas padang, nasi padang, foto makanan padang';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('gallery');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['pager']          = $GalleriesModel->pager;

        // Rendering View
        return view('frontoffice/gallery', $data);
    }
}
