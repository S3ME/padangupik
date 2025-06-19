<?php

namespace App\Controllers;

use CodeIgniter\Shield\Entities\User;

class Users extends BaseController
{
    public function index()
    {
        // Calling Models
        $UserModel  = auth()->getProvider();

        // Populating Data
        $activeUser = auth()->user();
        $users      = $UserModel->findAll();
        $userArray  = [];

        foreach ($users as $user) {
            $groups = implode(",", $user->getGroups());
            $arr = [
                'id'        => $user->id,
                'username'  => $user->username,
                'email'     => $user->email,
                'role'      => $groups
            ];
            $userArray[] = $arr;
        }

        // Parsing Data to View
        $data                   = $this->data ?? [];
        $data['title']          = 'Daftar Pengguna';
        $data['description']    = 'Kembangkan Bisnis Anda dengan Aplikasi yang Dirancang Khusus oleh Dismas Banar Purnandi.';
        $data['user']           = $activeUser;
        $data['users']          = $userArray;

        // Rendering View
        return view('backoffice/users', $data);
    }

    public function new()
    {
        // Calling Models
        $UserModel  = auth()->getProvider();

        // Populating Data
        $input = $this->request->getPost();

        // Validation Rules
        $rules = [
            'username'          => 'required|is_unique[users.username]|alpha_dash',
            'email'             => 'required|valid_email|is_unique[auth_identities.secret]',
            'password'          => 'required|alpha_numeric_punct|min_length[8]',
            'password-confirm'  => 'required_with[password]|matches[password]',
            'role'              => 'required'
        ];

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Processing Data
        $user = new User([
            'username'      => $input['username'],
            'email'         => $input['email'],
            'password'      => $input['password']
        ]);
        $UserModel->save($user);

        $user = $UserModel->findById($UserModel->getInsertID());

        $user->activate();

        $user->syncGroups($input['role']);

        return redirect()->back()->with('message', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id) {
        // Calling Models
        $UserModel  = auth()->getProvider();

        // Populating Data
        $input = $this->request->getPost();
        $user = $UserModel->findById($id);

        // Validation Rules
        $rules = [
            'username'          => 'required|is_unique[users.username,users.id,'.$id.']|alpha_dash',
            'email'             => 'required|valid_email|is_unique[auth_identities.secret,auth_identities.user_id,'.$id.']',
            'role'              => 'required'
        ];

        if (!empty($input['password'])) {
            $rules['password']          = 'alpha_numeric_punct|min_length[8]';
            $rules['password-confirm']  = 'required_with[password]|matches[password]';
        }

        // Validating
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Processing Data
        if (!empty($input['password'])) {
            $user->fill([
                'username'      => $input['username'],
                'email'         => $input['email'],
                'password'      => $input['password']
            ]);
        } else {
            $user->fill([
                'username'      => $input['username'],
                'email'         => $input['email']
            ]);
        }
        $UserModel->save($user);

        $user->syncGroups($input['role']);

        return redirect()->back()->with('message', 'Pengguna berhasil diubah');
    }

    public function delete()
    {
        // Calling Models
        $UserModel  = auth()->getProvider();

        // Populating Data
        $input = $this->request->getPost();

        // Processing Data
        $UserModel->delete($input['user-id'], true);

        return redirect()->back()->with('error', 'Pengguna berhasil dihapus');
    }
}