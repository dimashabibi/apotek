<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SatuanModel;

class SatuanController extends BaseController
{
    protected $satuanModel;

    public function __construct()
    {
        $this->satuanModel = new SatuanModel();
    }

    public function daftar_satuan()
    {
        $data = [
            'title'             => 'Daftar Satuan | Apotek Smber Sekar',
            'menu'              => 'master_data',
            'submenu'           => 'satuan',
            'satuan'            => $this->satuanModel->findAll()
        ];
        return view('item/daftar_satuan', $data);
    }

    //-------------------------- Tambah Satuan Obat ----------------------------------------

    public function tambah_satuan()
    {
        $this->satuanModel->insert([
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ]);
        session()->setFlashdata('success', 'Data satuan berhasil ditambah');
        return redirect()->to(base_url('/daftar_satuan'));
    }

    //-------------------------- Edit Satuan Obat ----------------------------------------

    public function edit_satuan($id)
    {
        $this->satuanModel->update($id, [
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ]);
        session()->setFlashdata('success', 'Data satuan berhasil diubah');
        return redirect()->to(base_url('/daftar_satuan'));
    }

    //-------------------------- Delete Satuan Obat ----------------------------------------

    public function delete_satuan($id)
    {
        $this->satuanModel->delete($id);
        session()->setFlashdata('success', 'Data satuan berhasil dihapus');
        return redirect()->to(base_url('/daftar_satuan'));
    }
}
