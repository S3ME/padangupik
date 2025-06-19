<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CategoriesModel;

class Products extends BaseController
{
    public function index()
    {
        // Calling Models
        $ProductsModel      = new ProductsModel();
        $CategoriesModel    = new CategoriesModel();

        // Populating Data
        $products           = $ProductsModel->orderBy('id', 'DESC')->findAll();
        $categories         = $CategoriesModel->orderBy('id', 'ASC')->findAll();

        // // Validating Data
        // if (!$products) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Menu Tidak Ditemukan');
        // }

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Menu';
        $data['description']    = 'Warung Padang Upik menyediakan berbagai menu makanan dan minuman khas Minang yang lezat dan berkualitas.';
        $data['keywords']       = 'menu, padang, upik, makanan, minuman, kuliner, minang, sumatera barat';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url();
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['products']       = $products;
        $data['categories']     = $categories;

        // Rendering View
        return view('frontoffice/product', $data);
    }

    public function detail($id)
    {
        // Calling Models
        $ProductsModel      = new ProductsModel();
        $CategoriesModel    = new CategoriesModel();

        // Populating Data
        $product    = $ProductsModel->find($id);
        $categories = $CategoriesModel->find($product['category_id'] ?? null);
        if ($categories) {
            $product['category_name'] = $categories['name'];
        } else {
            $product['category_name'] = 'Uncategorized';
        }

        // Validating Data
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Menu Tidak Ditemukan');
        }

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - ' . esc($product['name']);
        $data['description']    = 'Detail menu ' . esc($product['name']) . ' di Warung Padang Upik.';
        $data['keywords']       = 'menu, padang, upik, ' . esc($product['name']) . ', makanan, minuman, kuliner, minang, sumatera barat';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('product/' . $id);
        $data['image']          = base_url($product['image']);
        $data['product']        = $product;

        // Rendering View
        return view('frontoffice/product_detail', $data);
    }

    public function office()
    {
        // Calling Services
        $pager      = \Config\Services::pager();

        // Calling Models
        $ProductsModel      = new ProductsModel();
        $CategoriesModel    = new CategoriesModel();

        // Populating Data
        $productdata        = [];
        $products           = $ProductsModel->findAll();
        $categories         = $CategoriesModel->orderBy('id', 'ASC')->findAll();
        $user               = auth()->user();

        if (!empty($products)) {
            foreach ($products as $product) {
                $productcategories  = $CategoriesModel->find($product['category_id']);
                $productdata[]  = [
                    'id'            => $product['id'],
                    'cat_id'        => $product['category_id'],
                    'name'          => $product['name'],
                    'category'      => $productcategories['name'],
                    'description'   => $product['description'],
                    'image'         => $product['image'],
                    'favorite'      => $product['favorite'],
                ];
            }
        }
        array_multisort(array_column($productdata, 'id'), SORT_DESC, $productdata);

        $page       = (int) ($this->request->getGet('page') ?? 1);
        $perPage    = 20;
        $total      = count($productdata);
        $offset     = ($page - 1) * $perPage;

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Menu';
        $data['description']    = 'Warung Padang Upik menyediakan berbagai menu makanan dan minuman khas Minang yang lezat dan berkualitas.';
        $data['keywords']       = 'menu, padang, upik, makanan, minuman, kuliner, minang, sumatera barat';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('office/product');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['products']       = array_slice($productdata, $offset, $perPage);
        $data['categories']     = $categories;
        $data['user']           = $user;
        $data['pager_links']    = $pager->makeLinks($page, $perPage, $total, 'uikit_full');

        // Rendering View
        return view('backoffice/product', $data);
    }

    public function new()
    {
        // Calling Models
        $ProductsModel = new ProductsModel();

        // Populating Data
        $input = $this->request->getPost();

        // Validation Rules
        $rules = [
            'category'  => [
                'label'     => 'Kategori',
                'rules'     => 'required|is_natural_no_zero',
                'errors'    => [
                    'required'              => '{field} wajib dipilih.',
                    'is_natural_no_zero'    => '{field} harus berupa angka ID yang valid.'
                ]
            ],
            'name'  => [
                'label'     => 'Nama Menu',
                'rules'     => 'required|alpha_numeric_punct|is_unique[products.name]',
                'errors'    => [
                    'required'              => '{field} wajib diisi.',
                    'alpha_numeric_punct'   => '{field} hanya boleh berisi huruf, angka, dan simbol dasar.',
                    'is_unique'             => '{field} sudah digunakan.'
                ]
            ],
            'image' => [
                'label'     => 'Foto Menu',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa nama file.'
                ]
            ],
            'description'   => [
                'label'     => 'Deskripsi',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} wajib diisi.'
                ]
            ],
            'favorite'  => [
                'label'     => 'Favorite',
                'rules'     => 'required|in_list[0,1]',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'in_list'   => '{field} harus bernilai 0 atau 1.'
                ]
            ],
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Processing data
        $insert = [
            'category_id'   => $input['category'],
            'name'          => $input['name'],
            'description'   => $input['description'],
            'image'         => $input['image'],
            'favorite'      => $input['favorite']
        ];
        $ProductsModel->insert($insert);

        // Rendering View
        return redirect()->back()->with('message', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Calling Model
        $ProductsModel  = new ProductsModel();

        // Get old data
        $product        = $ProductsModel->find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan.');
        }

        // Populating Input
        $input = $this->request->getPost();

        // Validation Rules
        $rules = [
            'category' => [
                'label'     => 'Kategori',
                'rules'     => 'required|is_natural_no_zero',
                'errors'    => [
                    'required'              => '{field} wajib dipilih.',
                    'is_natural_no_zero'    => '{field} harus berupa angka ID yang valid.'
                ]
            ],
            'name' => [
                'label'     => 'Nama Menu',
                'rules'     => 'required|alpha_numeric_punct|is_unique[products.name,id,'.$id.']',
                'errors'    => [
                    'required'              => '{field} wajib diisi.',
                    'alpha_numeric_punct'   => '{field} hanya boleh berisi huruf, angka, dan simbol dasar.',
                    'is_unique'             => '{field} sudah digunakan.'
                ]
            ],
            'image' => [
                'label'     => 'Foto Menu',
                'rules'     => 'required|string',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'string'    => '{field} harus berupa nama file.'
                ]
            ],
            'description' => [
                'label'     => 'Deskripsi',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} wajib diisi.'
                ]
            ],
            'favorite' => [
                'label'     => 'Favorite',
                'rules'     => 'required|in_list[0,1]',
                'errors'    => [
                    'required'  => '{field} wajib diisi.',
                    'in_list'   => '{field} harus bernilai 0 atau 1.'
                ]
            ],
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Remove Image
        if ($product['image'] !== $input['image']) {
            @unlink('images/menu/'.$product['image']);
        }

        // Processing update
        $update = [
            'category_id'   => $input['category'],
            'name'          => $input['name'],
            'description'   => $input['description'],
            'image'         => $input['image'],
            'favorite'      => $input['favorite']
        ];

        $ProductsModel->update($id, $update);

        // Rendering View
        return redirect()->back()->with('message', 'Menu berhasil diperbarui.');
    }

    public function delete()
    {
        // Calling Models
        $ProductsModel  = new ProductsModel();

        // Populating Data
        $input          = $this->request->getPost();

        // Remove Image
        $product        = $ProductsModel->find($input['product-id']);
        @unlink('images/menu/'.$product['image']);
        
        // Validation Rules
        $rules = [
            'product-id'  => 'required'
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Processing Data
        $ProductsModel->delete($input['product-id']);
        $ProductsModel->purgeDeleted();

        // Rendering View
        return redirect()->back()->with('error', 'Menu berhasil dihapus.');
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
            $input->move(FCPATH . '/images/menu/', $filename);

            // Returning Message
            die(json_encode($filename));
        }
    }

    public function category()
    {
        // Calling Models
        $CategoriesModel    = new CategoriesModel();

        // Populating Data
        $user               = auth()->user();
        $categories         = $CategoriesModel->orderBy('name', 'ASC')->paginate(20,'categories');

        // // Validating Data
        // if (!$categories) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori Menu Tidak Ditemukan');
        // }

        // Parsing Data to Views
        $data                   = $this->data ?? [];
        $data['title']          = 'Warung Padang Upik - Kategori Menu';
        $data['description']    = 'Lihat berbagai kategori menu makanan dan minuman khas Minang di Warung Padang Upik. Temukan hidangan favorit Anda berdasarkan jenis dan selera.';
        $data['keywords']       = 'kategori menu, padang, makanan minang, kuliner sumatera, makanan tradisional, warung padang upik';
        $data['author']         = 'Warung Padang Upik';
        $data['url']            = base_url('office/category');
        $data['image']          = base_url('favicon/android-icon-192x192.png');
        $data['categories']     = $categories;
        $data['user']           = $user;
        $data['pager']          = $CategoriesModel->pager;

        // Rendering View
        return view('backoffice/category', $data);
    }

    public function newcategory()
    {
        // Calling Models
        $CategoriesModel    = new CategoriesModel();

        // Populating Data
        $input              = $this->request->getPost();

        // Validation Rules
        $rules = [
            'name'  => [
                'label'     => 'Nama Kategori',
                'rules'     => 'required|alpha_numeric_punct|is_unique[categories.name]',
                'errors'    => [
                    'required'              => '{field} wajib diisi.',
                    'alpha_numeric_punct'   => '{field} hanya boleh berisi huruf, angka, dan simbol dasar.',
                    'is_unique'             => '{field} sudah digunakan.'
                ]
            ],
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Processing data
        $insert = [
            'name'          => $input['name'],
        ];
        $CategoriesModel->insert($insert);

        // Rendering View
        return redirect()->back()->with('message', 'Kategori berhasil ditambahkan');
    }

    public function editcategory($id)
    {
        // Calling Model
        $CategoriesModel    = new CategoriesModel();

        // Get old data
        $categories         = $CategoriesModel->find($id);
        if (!$categories) {
            return redirect()->back()->with('error', 'Kategori Menu tidak ditemukan.');
        }

        // Populating Input
        $input = $this->request->getPost();

        // Validation Rules
        $rules = [
            'name' => [
                'label'     => 'Nama Kategori',
                'rules'     => 'required|alpha_numeric_punct|is_unique[categories.name,id,'.$id.']',
                'errors'    => [
                    'required'              => '{field} wajib diisi.',
                    'alpha_numeric_punct'   => '{field} hanya boleh berisi huruf, angka, dan simbol dasar.',
                    'is_unique'             => '{field} sudah digunakan.'
                ]
            ],
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Processing update
        $update = [
            'name'          => $input['name'],
        ];

        $CategoriesModel->update($id, $update);

        // Rendering View
        return redirect()->back()->with('message', 'Kategori berhasil diperbarui.');
    }

    public function deletecategory()
    {
        // Calling Models
        $CategoriesModel    = new CategoriesModel();

        // Populating Data
        $input              = $this->request->getPost();
        
        // Validation Rules
        $rules = [
            'category-id'  => 'required'
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Processing Data
        $CategoriesModel->delete($input['category-id']);
        $CategoriesModel->purgeDeleted();

        // Rendering View
        return redirect()->back()->with('error', 'Kategori berhasil dihapus.');
    }
}
