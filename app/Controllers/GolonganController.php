<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\GolonganModel;

class GolonganController extends BaseController
{
    protected $golonganModel;

    public function __construct()
    {
        $this->golonganModel = new GolonganModel();
    }

    public function daftar_golongan()
    {
        $data = [
            'title'             => 'Daftar Golongan | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'golongan',
            'golongan'          => $this->golonganModel->findAll(),
        ];

        return view('golongan/daftar_golongan', $data);
    }

    //-------------------------- Tambah Golongan Obat ----------------------------------------

    public function tambah_golongan()
    {
        $this->golonganModel->insert([
            'nama_golongan' => $this->request->getVar('nama_golongan'),
            'ket_golongan'  => $this->request->getVar('ket_golongan')
        ]);
        session()->setFlashdata('success', 'Data golongan berhasil ditambah');
        return redirect()->to(base_url('/daftar_golongan'));
    }

    //-------------------------- Edit Golongan Obat ----------------------------------------

    public function edit_golongan($id)
    {
        $this->golonganModel->update($id, [
            'nama_golongan' => $this->request->getVar('nama_golongan'),
            'ket_golongan'  => $this->request->getVar('ket_golongan')
        ]);
        session()->setFlashdata('success', 'Data golongan berhasil diubah');
        return redirect()->to(base_url('/daftar_golongan'));
    }

    //-------------------------- Delete Golongan Obat ----------------------------------------

    public function delete_golongan($id)
    {
        $this->golonganModel->delete($id);
        session()->setFlashdata('success', 'Data golongan berhasil dihapus');
        return redirect()->to(base_url('/daftar_golongan'));
    }
    // delete golongan end

    // ------------------------------------------------------------------------- tambah golongan Controller
    public function tambahGolongan()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'modalTambah' => view('item/modal_tambah')
            ];

            return $this->response->setJSON($msg);
        }
    }
    // tambah golongan  end

    // ------------------------------------------------------------------------- simpan golongan Controller
    public function simpanGolongan()
    {
        if ($this->request->isAJAX()) {

            $nama_golongan = $this->request->getVar('nama_golongan');
            $ket_golongan = $this->request->getVar('ket_golongan');

            $insertData = [
                'nama_golongan' => $nama_golongan,
                'ket_golongan' => $ket_golongan,
            ];

            $this->golonganModel->insert($insertData);

            $msg = ['success' => 'berhasil'];

            return $this->response->setJSON($msg);
        }
    }
}
