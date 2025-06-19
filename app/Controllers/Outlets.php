<?php

namespace App\Controllers;

use App\Models\OutletsModel;

class Outlets extends BaseController
{
    public function index()
    {
        // Calling Models
        $OutletsModel = new OutletsModel();

        // Populating Data
        $outlets = $OutletsModel->orderBy('name', 'ASC')->findAll();

        // // Validating Data
        // if (empty($outlets)) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Outlet Tidak Ditemukan');
        // }

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Outlets';
        $data['description']    = 'Temukan outlet Warung Padang Upik terdekat untuk menikmati hidangan Minang yang lezat.';
        $data['keywords']       = 'outlet, padang, upik, warung, minang, sumatera barat';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('outlet');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['outlets']        = $outlets;

        // Rendering View
        return view('frontoffice/outlet', $data);
    }

    public function office()
    {
        // Calling Models
        $OutletsModel       = new OutletsModel();

        // Populating Data
        $outlets            = $OutletsModel->orderBy('name', 'ASC')->paginate(20, 'outlets');
        $user               = auth()->user();

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Outlet';
        $data['description']    = 'Warung Padang Upik menyediakan berbagai outlet makanan dan minuman khas Minang yang lezat dan berkualitas.';
        $data['keywords']       = 'outlet, padang, upik, makanan, minuman, kuliner, minang, sumatera barat';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('office/outlet');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['outlets']        = $outlets;
        $data['user']           = $user;
        $data['pager']          = $OutletsModel->pager;

        // Rendering View
        return view('backoffice/outlet', $data);
    }

    public function new()
    {
        // Calling Models
        $OutletsModel   = new OutletsModel();

        // Populating Data
        $input          = $this->request->getPost();

        // Validation Rules
        $rules = [
            'name' => [
                'label'     => 'Nama Outlet',
                'rules'     => 'required|alpha_numeric_punct|is_unique[outlets.name]',
                'errors'    => [
                    'required'              => '{field} wajib diisi.',
                    'alpha_numeric_punct'   => '{field} hanya boleh berisi huruf, angka, dan simbol dasar.',
                    'is_unique'             => '{field} sudah digunakan.'
                ]
            ],
            'address' => [
                'label'     => 'Alamat',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa teks.'
                ]
            ],
            'phone' => [
                'label'     => 'Nomor Telepon',
                'rules'     => 'required|numeric|min_length[8]',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'numeric'       => '{field} harus berupa angka.',
                    'min_length'    => '{field} minimal 8 digit.'
                ]
            ],
            'operational_hours' => [
                'label'     => 'Jam Operasional',
                'rules'     => 'required|regex_match[/^[0-2][0-9]:[0-5][0-9] - [0-2][0-9]:[0-5][0-9]$/]',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'regex_match'   => '{field} harus dalam format HH:MM - HH:MM, contoh: 08:00 - 20:00.'
                ]
            ],
            'image' => [
                'label'     => 'Foto Tempat',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa nama file.'
                ]
            ],
            'maps' => [
                'label'     => 'Tautan Embed Maps',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa teks embed dari Google Maps.'
                ]
            ],
            'category' => [
                'label'     => 'Kota',
                'rules'     => 'required|alpha_space',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'alpha_space'   => '{field} hanya boleh berisi huruf dan spasi.'
                ]
            ],
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Processing data
        $insert = [
            'name'              => $input['name'],
            'address'           => $input['address'],
            'phone'             => $input['phone'],
            'operational_hours' => $input['operational_hours'],
            'image'             => $input['image'],
            'maps'              => $input['maps'],
            'category'          => $input['category'],
        ];
        $OutletsModel->insert($insert);

        // Rendering View
        return redirect()->back()->with('message', 'Outlet berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Calling Model
        $OutletsModel   = new OutletsModel();

        // Get old data
        $outlet         = $OutletsModel->find($id);
        if (!$outlet) {
            return redirect()->back()->with('error', 'Outlet tidak ditemukan.');
        }

        // Populating Input
        $input = $this->request->getPost();

        // Validation Rules
        $rules = [
            'name' => [
                'label'     => 'Nama Outlet',
                'rules'     => "required|alpha_numeric_punct|is_unique[outlets.name,id,{$id}]",
                'errors'    => [
                    'required'              => '{field} wajib diisi.',
                    'alpha_numeric_punct'   => '{field} hanya boleh berisi huruf, angka, dan simbol dasar.',
                    'is_unique'             => '{field} sudah digunakan oleh outlet lain.'
                ]
            ],
            'address' => [
                'label'     => 'Alamat',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa teks.'
                ]
            ],
            'phone' => [
                'label'     => 'Nomor Telepon',
                'rules'     => 'required|numeric|min_length[8]',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'numeric'       => '{field} harus berupa angka.',
                    'min_length'    => '{field} minimal 8 digit.'
                ]
            ],
            'operational_hours' => [
                'label'     => 'Jam Operasional',
                'rules'     => 'required|regex_match[/^[0-2][0-9]:[0-5][0-9] - [0-2][0-9]:[0-5][0-9]$/]',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'regex_match'   => '{field} harus dalam format HH:MM - HH:MM, contoh: 08:00 - 20:00.'
                ]
            ],
            'image' => [
                'label'     => 'Foto Tempat',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa nama file.'
                ]
            ],
            'maps' => [
                'label'     => 'Tautan Embed Maps',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa teks embed dari Google Maps.'
                ]
            ],
            'category' => [
                'label'     => 'Kota',
                'rules'     => 'required|alpha_space',
                'errors'    => [
                    'required'      => '{field} wajib diisi.',
                    'alpha_space'   => '{field} hanya boleh berisi huruf dan spasi.'
                ]
            ],
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Remove Image
        if ($outlet['image'] !== $input['image']) {
            @unlink('images/outlet/'.$outlet['image']);
        }

        // Processing update
        $update = [
            'name'              => $input['name'],
            'address'           => $input['address'],
            'phone'             => $input['phone'],
            'operational_hours' => $input['operational_hours'],
            'image'             => $input['image'],
            'maps'              => $input['maps'],
            'category'          => $input['category'],
        ];

        $OutletsModel->update($id, $update);

        // Rendering View
        return redirect()->back()->with('message', 'Outlet berhasil diperbarui.');
    }

    public function delete()
    {
        // Calling Models
        $OutletsModel   = new OutletsModel();

        // Populating Data
        $input          = $this->request->getPost();

        // Remove Image
        $outlet         = $OutletsModel->find($input['outlet-id']);
        @unlink('images/outlet/'.$outlet['image']);
        
        // Validation Rules
        $rules = [
            'outlet-id'  => 'required'
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Processing Data
        $OutletsModel->delete($input['outlet-id']);
        $OutletsModel->purgeDeleted();

        // Rendering View
        return redirect()->back()->with('error', 'Outlet berhasil dihapus.');
    }

    public function upload()
    {
        $input      = $this->request->getFile('upload');

        // Validation Rules
        $rules = [
            'upload'   => 'uploaded[upload]|is_image[upload]|max_size[upload,2048]',
        ];

        // Validating
        if (!$this->validate($rules)) {
            http_response_code(400);
            die(json_encode(array('message' => $this->validator->getErrors())));
        }

        if ($input->isValid() && !$input->hasMoved()) {
            $filename = $input->getRandomName();
            $input->move(FCPATH . '/images/outlet/', $filename);

            // Returning Message
            die(json_encode($filename));
        }
    }
}
