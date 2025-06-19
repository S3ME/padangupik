<?php

namespace App\Controllers;
use App\Models\OutletsModel;
use App\Models\ProductsModel;
use App\Models\GalleriesModel;
use App\Models\CategoriesModel;
use App\Models\BannersModel;
use CodeIgniter\Shield\Models\LoginModel;

class Office extends BaseController
{
    public function index()
    {
        // Calling Models
        $CategoriesModel    = new CategoriesModel();
        $ProductsModel      = new ProductsModel();
        $OutletsModel       = new OutletsModel();
        $GalleriesModel     = new GalleriesModel();
        $BannersModel       = new BannersModel();
        $UserModel          = auth()->getProvider();
        $LoginModel         = new LoginModel();

        // Populating Data
        $category       = $CategoriesModel->countAll();
        $lastCategories = $CategoriesModel->orderBy('id', 'DESC')->limit(1)->first();
        $product        = $ProductsModel->countAll();
        $lastProduct    = $ProductsModel->orderBy('id', 'DESC')->limit(1)->first();
        $outlet         = $OutletsModel->countAll();
        $lastOutlet     = $OutletsModel->orderBy('id', 'DESC')->limit(1)->first();
        $gallery        = $GalleriesModel->countAll();
        $lastGalleries  = $GalleriesModel->orderBy('id', 'DESC')->limit(1)->first();
        $banner         = $BannersModel->countAll();
        $lastBanners    = $BannersModel->orderBy('id', 'DESC')->limit(1)->first();
        $users          = $UserModel->countAll();
        $user           = auth()->user();
        $userId         = auth()->id();
        $logins         = $LoginModel->orderBy('date', 'DESC')->where('user_id', $userId)->where('success', 1)->findAll(2);
        $lastLogin      = $logins[1]->date ?? null;

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Dashboard';
        $data['description']    = 'Bawa ide aplikasi Anda menjadi kenyataan dengan Kodebiner! Kami membengun aplikasi sesuai dengan kebutuhan bisnis Anda.';
        $data['user']           = $user;
        $data['totalOutlet']    = $outlet;
        $data['totalProduct']   = $product;
        $data['totalGallery']   = $gallery;
        $data['totalCategory']  = $category;
        $data['totalBanner']    = $banner;
        $data['totalUser']      = $users;
        $data['lastLogin']      = $lastLogin;
        $data['lastProduct']    = $lastProduct['name'] ?? null;
        $data['lastOutlet']     = $lastOutlet['name'] ?? null;
        $data['lastGalleries']  = $lastGalleries['created_at'] ?? null;
        $data['lastCategories'] = $lastCategories['name'] ?? null;
        $data['lastBanners']    = $lastBanners['created_at'] ?? null;

        // Rendering View
        return view('backoffice/dashboard', $data);
    }
}