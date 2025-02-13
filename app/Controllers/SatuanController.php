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
        return view('satuan/daftar_satuan', $data);
    }

    //-------------------------- Tambah Satuan Obat ----------------------------------------

    public function tambah_satuan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_satuan' => [
                'label'  => 'Nama Satuan',
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Satuan belum diinput',
                    'max_length' => 'Maksimal 50 karakter',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
            $this->satuanModel->insert([
                'nama_satuan' => $this->request->getVar('nama_satuan')
            ]);
            session()->setFlashdata('success', 'Data satuan berhasil ditambah');
            return redirect()->to(base_url('/daftar_satuan'));
        }
    }

    //-------------------------- Edit Satuan Obat ----------------------------------------

    public function edit_satuan($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_satuan' => [
                'label'  => 'Nama Satuan',
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Satuan belum diinput',
                    'max_length' => 'Maksimal 50 karakter',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
            $this->satuanModel->update($id, [
                'nama_satuan' => $this->request->getVar('nama_satuan')
            ]);
            session()->setFlashdata('success', 'Data satuan berhasil diubah');
            return redirect()->to(base_url('/daftar_satuan'));
        }
    }

    //-------------------------- Delete Satuan Obat ----------------------------------------

    public function delete_satuan($id)
    {
        $this->satuanModel->delete($id);
        session()->setFlashdata('success', 'Data satuan berhasil dihapus');
        return redirect()->to(base_url('/daftar_satuan'));
    }

    // ------------------------------------------------------------------------- tambah Satuan Controller
    public function tambahSatuan()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'modalTambah' => view('item/modal_tambah')
            ];

            return $this->response->setJSON($msg);
        }
    }
    // tambah Satuan  end

    // ------------------------------------------------------------------------- simpan Satuan Controller
    public function simpanSatuan()
    {
        if ($this->request->isAJAX()) {

            $nama_satuan = $this->request->getVar('nama_satuan');

            $insertData = [
                'nama_satuan' => $nama_satuan,
            ];

            $this->satuanModel->insert($insertData);

            $msg = ['success' => 'berhasil'];

            return $this->response->setJSON($msg);
        }
    }
}
