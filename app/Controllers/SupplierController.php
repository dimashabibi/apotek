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
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_supplier' => [
                'label'  => 'Nama Supplier',
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Supplier belum diinput',
                    'max_length' => 'Maksimal 150 karakter',
                ],
            ],
            'alamat_supplier' => [
                'label'  => 'Alamat Supplier',
                'rules'  => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Maksimal 255 karakter',
                ],
            ],
            'kota' => [
                'label'  => 'Kota',
                'rules'  => 'max_length[50]',
                'errors' => [
                    'max_length' => 'Maksimal 50 karakter',
                ],
            ],
            'ket_supplier' => [
                'label'  => 'Keterangan',
                'rules'  => 'max_length[100]',
                'errors' => [
                    'max_length' => 'Maksimal 100 karakter',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
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
    }

    //-------------------------- Edit supplier Obat ----------------------------------------

    public function edit_supplier($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_supplier' => [
                'label'  => 'Nama Supplier',
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Supplier belum diinput',
                    'max_length' => 'Maksimal 150 karakter',
                ],
            ],
            'alamat_supplier' => [
                'label'  => 'Alamat Supplier',
                'rules'  => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Maksimal 255 karakter',
                ],
            ],
            'kota' => [
                'label'  => 'Kota',
                'rules'  => 'max_length[50]',
                'errors' => [
                    'max_length' => 'Maksimal 50 karakter',
                ],
            ],
            'ket_supplier' => [
                'label'  => 'Keterangan',
                'rules'  => 'max_length[100]',
                'errors' => [
                    'max_length' => 'Maksimal 100 karakter',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
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
    }

    //-------------------------- Delete supplier Obat ----------------------------------------

    public function delete_supplier($id)
    {
        $this->supplierModel->delete($id);
        session()->setFlashdata('success', 'Data supplier berhasil dihapus');
        return redirect()->to(base_url('/daftar_supplier'));
    }

    public function tambahSupplier()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'modalTambah' => view('item/modal_tambah')
            ];

            return $this->response->setJSON($msg);
        }
    }

    public function simpanSupplier()
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

        $msg = [
            'success' => 'berhasil'
        ];
        return $this->response->setJSON($msg);
    }
}
