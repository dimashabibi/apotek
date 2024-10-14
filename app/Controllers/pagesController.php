<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObatModel;
use App\Models\KategoriModel;
use App\Models\GolonganModel;
use App\Models\SupplierModel;
use App\Models\PabrikModel;
use App\Models\SatuanModel;
use App\Models\EtiketModel;
use App\Models\TransaksiModel;
use App\Models\TempModel;


class PagesController extends BaseController
{

    protected $obatModel;
    protected $kategoriModel;
    protected $golonganModel;
    protected $supplierModel;
    protected $pabrikModel;
    protected $satuanModel;
    protected $etiketModel;
    protected $transaksiModel;
    protected $tempModel;

    public function __construct()
    {
        $this->obatModel        = new ObatModel();
        $this->kategoriModel    = new KategoriModel();
        $this->golonganModel    = new GolonganModel();
        $this->supplierModel    = new SupplierModel();
        $this->pabrikModel      = new PabrikModel();
        $this->satuanModel      = new SatuanModel();
        $this->etiketModel      = new EtiketModel();
        $this->transaksiModel   = new TransaksiModel();
        $this->tempModel        = new TempModel();
    }

    public function home()
    {
        $data = [
            'title'             => 'Dashboard | Apotek Sumbersekar',
            'menu'              => 'dashboard',
            'submenu'           => '',
            'total_obat'        => $this->obatModel->countAllResults(),
            'total_kategori'    => $this->kategoriModel->countAllResults(),
            'total_supplier'    => $this->supplierModel->countAllResults(),
        ];
        return view('pages/home', $data);
    }

    public function kasir()
    {
        $no_faktur = $this->transaksiModel->getNoFaktur();
        $data = [
            'title'             => 'Kasir | Apotek Sumbersekar',
            'menu'              => 'kasir',
            'submenu'           => '',
            'breadcrumb_active' => 'Kasir',
            'no_faktur'         => $no_faktur,
            'obat'              => $this->obatModel->getObat(),
        ];
        return view('pages/kasir', $data);
    }

    public function cekObat()
    {
        // Ambil variabel dari request (gunakan getPost() jika request menggunakan POST)
        $nama_obat = $this->request->getVar('nama_obat');

        // Query model untuk mencari obat
        $obat = $this->obatModel->cekObat($nama_obat);

        // Jika obat tidak ditemukan, set data kosong
        if ($obat == null) {
            $data = [
                'barcode_obat'       => '',
                'nama_kategori'      => '',
                'nama_satuan'        => '',
                'harga_jual'         => '',
            ];
        } else {
            // Jika obat ditemukan, masukkan data obat
            $data = [
                'barcode_obat'    => $obat['barcode_obat'],
                'nama_kategori'   => $obat['nama_kategori'],
                'nama_satuan'     => $obat['nama_satuan'],
                'harga_jual'      => $obat['harga_jual'],
            ];
        }

        // Kirim respons dalam format JSON
        return $this->response->setJSON($data);
    }

    // Controller method
    public function dataDetail()
    {
        $no_faktur = $this->request->getVar('no_faktur');
        $detail = $this->transaksiModel->getTemp($no_faktur);

        $data = [
            'datadetail' => $detail
        ];
        $msg = [
            'data' => view('item/view_detail', $data)
        ];

        return $this->response->setJSON($msg);
    }
}
