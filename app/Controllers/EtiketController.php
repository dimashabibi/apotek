<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EtiketModel;

class EtiketController extends BaseController
{
    protected $etiketModel;

    public function __construct()
    {
        $this->etiketModel = new EtiketModel();
    }

    public function daftar_etiket()
    {
        $data = [
            'title'             => 'Daftar Etiket | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'etiket',
            'etiket'            => $this->etiketModel->findAll(),
        ];

        return view('item/daftar_etiket', $data);
    }

    //-------------------------- Tambah etiket Obat ----------------------------------------

    public function tambah_etiket()
    {
        $this->etiketModel->insert([
            'nama_etiket' => $this->request->getVar('nama_etiket'),
            'ket_etiket'  => $this->request->getVar('ket_etiket')
        ]);
        session()->setFlashdata('success', 'Data etiket berhasil ditambah');
        return redirect()->to(base_url('/daftar_etiket'));
    }

    //-------------------------- Edit etiket Obat ----------------------------------------

    public function edit_etiket($id)
    {
        $this->etiketModel->update($id, [
            'nama_etiket' => $this->request->getVar('nama_etiket'),
            'ket_etiket'  => $this->request->getVar('ket_etiket')
        ]);
        session()->setFlashdata('success', 'Data etiket berhasil diubah');
        return redirect()->to(base_url('/daftar_etiket'));
    }

    //-------------------------- Delete etiket Obat ----------------------------------------

    public function delete_etiket($id)
    {
        $this->etiketModel->delete($id);
        session()->setFlashdata('success', 'Data etiket berhasil dihapus');
        return redirect()->to(base_url('/daftar_etiket'));
    }
}