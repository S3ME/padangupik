<?php

namespace App\Controllers;

use App\Models\GalleriesModel;

class Gallery extends BaseController
{
    public function index()
    {
        // Calling Models
        $GalleriesModel         = new GalleriesModel();

        // Populating Data
        $user                   = auth()->user();
        $galleries              = $GalleriesModel->orderBy('id', 'DESC')->paginate(20, 'galleries');

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Galeri Foto';
        $data['description']    = 'Lihat dokumentasi berbagai event seru di Warung Padang Upik. Temukan momen spesial, kegiatan menarik, dan suasana khas Minang yang hangat dan bersahabat.';
        $data['keywords']       = 'galeri foto, event padang upik, dokumentasi acara, foto warung padang, kegiatan warung padang upik, suasana minang, warung padang upik';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('office/gallery');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['galleries']      = $galleries;
        $data['user']           = $user;
        $data['pager']          = $GalleriesModel->pager;

        // Rendering View
        return view('backoffice/gallery', $data);
    }

    public function upload()
    {
        // Calling Models
        $GalleriesModel = new GalleriesModel();

        // Populating Data
        $input = $this->request->getFile('upload');

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
            $input->move(FCPATH . '/images/gallery/', $filename);

            $GalleriesModel->insert(['image' => $filename]);
            $id = $GalleriesModel->getInsertID();

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
        $GalleriesModel = new GalleriesModel();

        // Populating Data
        $input = $this->request->getPost();
        $gallery = $GalleriesModel->find($input['id']);

        // Processing Data
        if (!empty($gallery)) {
            unlink('images/gallery/'.$gallery['image']);
            $GalleriesModel->delete($input['id'], true);

            return redirect()->back()->with('error', 'Foto berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}