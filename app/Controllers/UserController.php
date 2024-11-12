<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function daftar_user()
    {
        $data = [
            'title'             => 'Daftar User | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'user',
            'user'              => $this->userModel->findAll()
        ];
        return view('user/daftar_user', $data);
    }

    public function edit_user($id)
    {

        $this->userModel->update($id, [
            'nama_user' => $this->request->getVar('nama_user'),
            'username'  => $this->request->getVar('username'),
            'nohp'      => $this->request->getVar('nohp'),
            'email'     => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
            'role'      => $this->request->getVar('role'),
        ]);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url('daftar_user'));
    }

    public function delete_user($id)
    {
        $this->userModel->delete($id);
        \session()->setFlashdata('success', 'Data berhasil dihapus');
        return \redirect()->to(\base_url('daftar_user'));
    }
}
