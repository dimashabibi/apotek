<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObatModel;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $obatModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->obatModel     = new ObatModel();
        $this->kategoriModel = new KategoriModel();
    }

    //-------------------------- Kategori Obat ----------------------------------------

    public function daftar_kategori()
    {
        $kategori_id = null;
        $data = [
            'title'             => 'Kategori Page',
            'menu'              => 'master_data',
            'submenu'           => 'kategori',
            'obat'              => $this->kategoriModel->getNestedObat($kategori_id),
            'kategori'          => $this->kategoriModel->findAll(),
        ];

        return view('item/daftar_kategori', $data);
    }

    //-------------------------- tambah Kategori Obat ----------------------------------------
    public function tambah_kategori()
    {
        $this->kategoriModel->insert([
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'ket_kategori'  => $this->request->getVar('ket_kategori'),
        ]);

        session()->setFlashdata('success', 'Kategori berhasil ditambah');
        return redirect()->to(base_url('/daftar_kategori'));
    }

    //-------------------------- edit Kategori Obat ----------------------------------------
    public function edit_kategori($id)
    {
        $this->kategoriModel->update($id, [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'ket_kategori'  => $this->request->getVar('ket_kategori'),
        ]);

        session()->setFlashdata('success', 'Kategori berhasil diubah');
        return redirect()->to(base_url('/daftar_kategori'));
    }

    //-------------------------- Delete Kategori Obat ----------------------------------------
    public function delete_kategori($id)
    {
        $this->kategoriModel->delete($id);
        session()->setFlashdata('success', 'Kategori berhasil dihapus');
        return redirect()->to(base_url('/daftar_kategori'));
    }
}
