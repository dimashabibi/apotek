<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObatModel;
use App\Models\KategoriModel;

class ObatController extends BaseController
{
    protected $obatModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->obatModel = new ObatModel();
        $this->kategoriModel = new KategoriModel();
    }

    //--------------------------Daftar Obat ----------------------------------------
    public function daftar_obat()
    {
        $data = [
            'title'             => 'Daftar Obat',
            'content_header'    => 'Daftar Obat',
            'breadcrumb'        => 'Obat',
            'breadcrumb_active' => 'Daftar Obat',
            'list_obat'         => $this->obatModel->getObat(),
            'kategori'         => $this->kategoriModel->findAll(),
        ];
        return view('obat/daftar_obat', $data);
    }

    //-------------------------- Tambah Obat ----------------------------------------
    public function tambah_obat()
    {

        $this->obatModel->insert([
            'barcode'         => $this->request->getVar('barcode'),
            'nama_obat'       => $this->request->getVar('nama_obat'),
            'stok_obat'       => $this->request->getVar('stok_obat'),
            'satuan'          => $this->request->getVar('satuan'),
            'jenis_obat'      => $this->request->getVar('jenis_obat'),
            'id_kategori'   => $this->request->getVar('id_kategori'),
            'merk_obat'       => $this->request->getVar('merk_obat'),
            'harga_pokok'     => $this->request->getVar('harga_pokok'),
            'harga_jual'      => $this->request->getVar('harga_jual'),
            'stok_min'        => $this->request->getVar('stok_min'),
            'keterangan_obat' => $this->request->getVar('keterangan_obat'),
            'supplier'        => $this->request->getVar('supplier'),
        ]);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('/daftar_obat'));
    }

    //--------------------------Edit Obat ----------------------------------------
    public function edit_obat($id)
    {

        $this->obatModel->update($id, [
            'barcode'         => $this->request->getVar('barcode'),
            'nama_obat'       => $this->request->getVar('nama_obat'),
            'stok_obat'       => $this->request->getVar('stok_obat'),
            'satuan'          => $this->request->getVar('satuan'),
            'jenis_obat'      => $this->request->getVar('jenis_obat'),
            'id_kategori'   => $this->request->getVar('id_kategori'),
            'merk_obat'       => $this->request->getVar('merk_obat'),
            'harga_pokok'     => $this->request->getVar('harga_pokok'),
            'harga_jual'      => $this->request->getVar('harga_jual'),
            'stok_min'        => $this->request->getVar('stok_min'),
            'keterangan_obat' => $this->request->getVar('keterangan_obat'),
            'supplier'        => $this->request->getVar('supplier'),
        ]);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url('/daftar_obat'));
    }

    //-------------------------- Delete Obat ----------------------------------------
    public function delete_obat($id)
    {
        $this->obatModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('/daftar_obat'));
    }

    //-------------------------- Kategori Obat ----------------------------------------

    public function daftar_kategori(){

        $kategoriId = 1;

        $data=[
            'title' => 'Kategori Page',
            'content_header'    => 'Daftar Kategori',
            'breadcrumb'        => 'Obat',
            'breadcrumb_active' => 'Daftar Kategori',
            'list_obat'         => $this->obatModel->getObatById($kategoriId),
            'kategori'         => $this->kategoriModel->findAll(),
        ];
        return view('obat/daftar_kategori', $data);
    }

     //-------------------------- tambah Kategori Obat ----------------------------------------
    public function tambah_kategori(){
        $this->kategoriModel->insert([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);
        
        session()->setFlashdata('success', 'Kategori berhasil ditambah');
        return redirect()->to(base_url('/daftar_kategori'));
    }
}
