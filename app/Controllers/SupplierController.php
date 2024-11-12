<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SupplierModel;

class SupplierController extends BaseController
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function daftar_supplier()
    {
        $data = [
            'title'             => 'Daftar Supplier | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'supplier',
            'supplier'          => $this->supplierModel->findAll(),
        ];

        return view('supplier/daftar_supplier', $data);
    }

    //-------------------------- Tambah supplier Obat ----------------------------------------

    public function tambah_supplier()
    {
        $this->supplierModel->insert([
            'nama_supplier'    => $this->request->getVar('nama_supplier'),
            'alamat_supplier'  => $this->request->getVar('alamat_supplier'),
            'kota'             => $this->request->getVar('kota'),
            'no_telp'          => $this->request->getVar('no_telp'),
            'no_hp'            => $this->request->getVar('no_hp'),
            'no_rekening'      => $this->request->getVar('no_rekening'),
            'npwp'             => $this->request->getVar('npwp'),
            'ket_supplier'     => $this->request->getVar('ket_supplier'),
        ]);
        session()->setFlashdata('success', 'Data supplier berhasil ditambah');
        return redirect()->to(base_url('/daftar_supplier'));
    }

    //-------------------------- Edit supplier Obat ----------------------------------------

    public function edit_supplier($id)
    {
        $this->supplierModel->update($id, [
            'nama_supplier'    => $this->request->getVar('nama_supplier'),
            'alamat_supplier'  => $this->request->getVar('alamat_supplier'),
            'kota'             => $this->request->getVar('kota'),
            'no_telp'          => $this->request->getVar('no_telp'),
            'no_hp'            => $this->request->getVar('no_hp'),
            'no_rekening'      => $this->request->getVar('no_rekening'),
            'npwp'             => $this->request->getVar('npwp'),
            'ket_supplier'     => $this->request->getVar('ket_supplier'),
        ]);
        session()->setFlashdata('success', 'Data supplier berhasil diubah');
        return redirect()->to(base_url('/daftar_supplier'));
    }

    //-------------------------- Delete supplier Obat ----------------------------------------

    public function delete_supplier($id)
    {
        $this->supplierModel->delete($id);
        session()->setFlashdata('success', 'Data supplier berhasil dihapus');
        return redirect()->to(base_url('/daftar_supplier'));
    }
}
