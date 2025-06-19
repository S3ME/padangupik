<?php

namespace App\Controllers;

use App\Models\BannersModel;

class Banners extends BaseController
{
    public function index()
    {
        // Calling Models
        $BannersModel           = new BannersModel();

        // Populating Data
        $user                   = auth()->user();
        $banners                = $BannersModel->orderBy('id', 'DESC')->paginate(20, 'banners');

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Banner';
        $data['description']    = 'Jelajahi berbagai banner promosi, informasi acara, dan pengumuman terbaru dari Warung Padang Upik. Dapatkan update seputar promo menarik dan momen spesial hanya di sini.';
        $data['keywords']       = 'banner warung padang upik, promo padang upik, informasi warung padang, pengumuman event, gambar promosi, info spesial padang, banner restoran minang';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('office/banner');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['banners']        = $banners;
        $data['user']           = $user;
        $data['pager']          = $BannersModel->pager;

        // Rendering View
        return view('backoffice/banner', $data);
    }

    public function upload()
    {
        // Calling Models
        $BannersModel   = new BannersModel();

        // Populating Data
        $input  = $this->request->getFile('upload');

        // Validation Rules
        $rules = [
            'upload'   => 'uploaded[upload]|is_image[upload]|max_size[upload,1000]',
        ];

        // Validating
        if (!$this->validate($rules)) {
            http_response_code(400);
            die(json_encode(array('message' => $this->validator->getErrors())));
        }

        // Processing Data
        if ($input->isValid() && !$input->hasMoved()) {
            $filename = $input->getRandomName();
            $input->move(FCPATH . '/images/banner/', $filename);

            $BannersModel->insert(['image' => $filename]);
            $id = $BannersModel->getInsertID();

            $return = [
                'id'        => $id,
                'filename'  => $filename
            ];

            // Returning Message
            die(json_encode($return));
        }
    }

    public function delete()
    {
        // Calling Models
        $BannersModel   = new BannersModel();

        // Populating Data
        $input          = $this->request->getPost();
        $banner         = $BannersModel->find($input['id']);

        // Processing Data
        if (!empty($banner)) {
            unlink('images/banner/'.$banner['image']);
            $BannersModel->delete($input['id'], true);

            return redirect()->back()->with('error', 'Banner berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}