<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PabrikModel;

class PabrikController extends BaseController
{
    protected $pabrikModel;

    public function __construct()
    {
        $this->pabrikModel = new PabrikModel();
    }

    public function daftar_pabrik()
    {
        $data = [
            'title'             => 'Daftar Pabrik | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'pabrik',
            'pabrik'            => $this->pabrikModel->findAll(),
        ];

        return view('pabrik/daftar_pabrik', $data);
    }

    //-------------------------- Tambah pabrik Obat ----------------------------------------

    public function tambah_pabrik()
    {
        $this->pabrikModel->insert([
            'nama_pabrik'      => $this->request->getVar('nama_pabrik'),
            'alamat_pabrik'    => $this->request->getVar('alamat_pabrik'),
            'kota'             => $this->request->getVar('kota'),
            'no_telp'          => $this->request->getVar('no_telp'),
            'no_hp'            => $this->request->getVar('no_hp'),
            'no_rekening'      => $this->request->getVar('no_rekening'),
            'npwp'             => $this->request->getVar('npwp'),
            'ket_pabrik'       => $this->request->getVar('ket_pabrik'),
        ]);
        session()->setFlashdata('success', 'Data pabrik berhasil ditambah');
        return redirect()->to(base_url('/daftar_pabrik'));
    }

    //-------------------------- Edit pabrik Obat ----------------------------------------

    public function edit_pabrik($id)
    {
        $this->pabrikModel->update($id, [
            'nama_pabrik'      => $this->request->getVar('nama_pabrik'),
            'alamat_pabrik'    => $this->request->getVar('alamat_pabrik'),
            'kota'             => $this->request->getVar('kota'),
            'no_telp'          => $this->request->getVar('no_telp'),
            'no_hp'            => $this->request->getVar('no_hp'),
            'no_rekening'      => $this->request->getVar('no_rekening'),
            'npwp'             => $this->request->getVar('npwp'),
            'ket_pabrik'       => $this->request->getVar('ket_pabrik'),
        ]);
        session()->setFlashdata('success', 'Data pabrik berhasil diubah');
        return redirect()->to(base_url('/daftar_pabrik'));
    }

    //-------------------------- Delete pabrik Obat ----------------------------------------

    public function delete_pabrik($id)
    {
        $this->pabrikModel->delete($id);
        session()->setFlashdata('success', 'Data pabrik berhasil dihapus');
        return redirect()->to(base_url('/daftar_pabrik'));
    }
}
