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
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_user' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Nama user tidak boleh kosong.',
                    'max_length' => 'Nama user tidak boleh lebih dari 100 karakter.',
                ],
            ],
            'username' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Username tidak boleh kosong.',
                    'max_length' => 'Username tidak boleh lebih dari 100 karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|max_length[255]|valid_email',
                'errors' => [
                    'required'   => 'Email tidak boleh kosong.',
                    'max_length' => 'Email tidak boleh lebih dari 255 karakter.',
                    'valid_email' => 'Format email tidak valid.',
                ],
            ],
            'nohp' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nomor HP tidak boleh kosong.',
                ],
            ],
            'role' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Role harus dipilih.',
                ],
            ],
        ]);
        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
            $this->userModel->update($id, [
                'nama_user' => $this->request->getVar('nama_user'),
                'username'  => $this->request->getVar('username'),
                'nohp'      => $this->request->getVar('nohp'),
                'email'     => $this->request->getVar('email'),
                'role'      => $this->request->getVar('role'),
            ]);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('daftar_user'));
        }
    }

    public function delete_user($id)
    {
        $this->userModel->delete($id);
        \session()->setFlashdata('success', 'Data berhasil dihapus');
        return \redirect()->to(\base_url('daftar_user'));
    }
}
