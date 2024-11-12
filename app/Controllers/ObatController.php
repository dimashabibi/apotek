<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObatModel;
use App\Models\KategoriModel;
use App\Models\GolonganModel;;

use App\Models\SatuanModel;
use App\Models\EtiketModel;

class ObatController extends BaseController
{
    protected $obatModel;
    protected $kategoriModel;
    protected $golonganModel;
    protected $satuanModel;
    protected $etiketModel;

    public function __construct()
    {
        $this->obatModel     = new ObatModel();
        $this->kategoriModel = new KategoriModel();
        $this->golonganModel = new GolonganModel();
        $this->satuanModel   = new SatuanModel();
        $this->etiketModel   = new EtiketModel();
    }

    //--------------------------Daftar Obat ----------------------------------------
    public function daftar_obat()
    {
        $data = [
            'title'             => 'Daftar Obat | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'obat',
            'obat'              => $this->obatModel->getObat(),
            'kategori'          => $this->kategoriModel->getKategori(),
        ];
        return view('obat/daftar_obat', $data);
    }

    //-------------------------- Tambah Obat ----------------------------------------

    public function create_obat()
    {

        $data = [
            'title'             => 'Tambah Data Obat | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'obat',
            'obat'              => $this->obatModel->getObat(),
            'kategori'          => $this->kategoriModel->findAll(),
            'golongan'          => $this->golonganModel->findAll(),
            'satuan'            => $this->satuanModel->findAll(),
            'etiket'            => $this->etiketModel->findAll(),
        ];
        return view('obat/create_obat', $data);
    }

    public function tambah_obat()
    {

        $this->obatModel->insert([
            'kode_rak'          => $this->request->getVar('kode_rak'),
            'barcode_obat'      => $this->request->getVar('barcode_obat'),
            'merk_obat'         => $this->request->getVar('merk_obat'),
            'nama_obat'         => $this->request->getVar('nama_obat'),
            'id_golongan'       => $this->request->getVar('id_golongan'),
            'id_kategori'       => $this->request->getVar('id_kategori'),
            'konsinyasi'        => $this->request->getVar('konsinyasi'),
            'stok_min'          => \str_replace(",", "", $this->request->getVar('stok_min')),
            'stok_obat'         => \str_replace(",", "", $this->request->getVar('stok_obat')),
            'id_satuan'         => $this->request->getVar('id_satuan'),
            'harga_pokok'       => \str_replace(",", "", $this->request->getVar('harga_pokok')),
            'harga_jual'        => \str_replace(",", "", $this->request->getVar('harga_jual')),
            'id_etiket'         => $this->request->getVar('id_etiket'),

        ]);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('/daftar_obat'));
    }

    //--------------------------Edit Obat ----------------------------------------

    public function edit_obat($id)
    {

        $obat     = $this->obatModel->find($id);
        $kategori = $this->kategoriModel->find($obat['id_kategori']);
        $golongan = $this->golonganModel->find($obat['id_golongan']);
        $satuan   = $this->satuanModel->find($obat['id_satuan']);
        $etiket   = $this->etiketModel->find($obat['id_etiket']);


        $data = [
            'title'               => 'Edit Data Obat | Apotek Sumbersekar',
            'menu'                => 'master_data',
            'submenu'             => 'obat',
            'obat'                => $obat,
            'kategoriId'          => $kategori,
            'golonganId'          => $golongan,
            'satuanId'            => $satuan,
            'etiketId'            => $etiket,
            'kategori'            => $this->kategoriModel->findAll(),
            'golongan'            => $this->golonganModel->findAll(),
            'satuan'              => $this->satuanModel->findAll(),
            'etiket'              => $this->etiketModel->findAll(),
        ];
        return view('obat/edit_obat', $data);
    }

    public function update($id)
    {

        $this->obatModel->update($id, [
            'kode_rak'          => $this->request->getVar('kode_rak'),
            'barcode_obat'      => $this->request->getVar('barcode_obat'),
            'merk_obat'         => $this->request->getVar('merk_obat'),
            'nama_obat'         => $this->request->getVar('nama_obat'),
            'id_golongan'       => $this->request->getVar('id_golongan'),
            'id_kategori'       => $this->request->getVar('id_kategori'),
            'konsinyasi'        => $this->request->getVar('konsinyasi'),
            'stok_min'          => \str_replace(",", "", $this->request->getVar('stok_min')),
            'stok_obat'         => \str_replace(",", "", $this->request->getVar('stok_obat')),
            'id_satuan'         => $this->request->getVar('id_satuan'),
            'harga_pokok'       => \str_replace(",", "", $this->request->getVar('harga_pokok')),
            'harga_jual'        => \str_replace(",", "", $this->request->getVar('harga_jual')),
            'id_etiket'         => $this->request->getVar('id_etiket'),
        ]);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to(base_url('/daftar_obat'));
    }
}
