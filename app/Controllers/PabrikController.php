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
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pabrik' => [
                'label'  => 'Nama Pabrik',
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 150 karakter',
                ],
            ],
            'alamat_pabrik' => [
                'label'  => 'Alamat Pabrik',
                'rules'  => 'max_length[255]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 255 karakter',
                ],
            ],
            'kota' => [
                'label'  => 'Kota',
                'rules'  => 'max_length[50]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 50 karakter',
                ],
            ],
            'ket_pabrik' => [
                'label'  => 'Keterangan',
                'rules'  => 'max_length[100]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 100 karakter',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
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
    }

    //-------------------------- Edit pabrik Obat ----------------------------------------

    public function edit_pabrik($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pabrik' => [
                'label'  => 'Nama Pabrik',
                'rules'  => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 150 karakter',
                ],
            ],
            'alamat_pabrik' => [
                'label'  => 'Alamat Pabrik',
                'rules'  => 'max_length[255]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 255 karakter',
                ],
            ],
            'kota' => [
                'label'  => 'Kota',
                'rules'  => 'max_length[50]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 50 karakter',
                ],
            ],
            'ket_pabrik' => [
                'label'  => 'Keterangan',
                'rules'  => 'max_length[100]',
                'errors' => [
                    'required' => 'Nama Pabrik belum diinput',
                    'max_length' => 'Maksimal 100 karakter',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
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
    }

    //-------------------------- Delete pabrik Obat ----------------------------------------

    public function delete_pabrik($id)
    {
        $this->pabrikModel->delete($id);
        session()->setFlashdata('success', 'Data pabrik berhasil dihapus');
        return redirect()->to(base_url('/daftar_pabrik'));
    }
}
