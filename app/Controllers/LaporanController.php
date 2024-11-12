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
use App\Models\DetailTransaksiModel;
use App\Models\TempModel;

class LaporanController extends BaseController
{

    protected $obatModel;
    protected $kategoriModel;
    protected $golonganModel;
    protected $supplierModel;
    protected $pabrikModel;
    protected $satuanModel;
    protected $etiketModel;
    protected $transaksiModel;
    protected $detailtransaksiModel;
    protected $tempModel;

    public function __construct()
    {
        $this->obatModel              = new ObatModel();
        $this->kategoriModel          = new KategoriModel();
        $this->golonganModel          = new GolonganModel();
        $this->supplierModel          = new SupplierModel();
        $this->pabrikModel            = new PabrikModel();
        $this->etiketModel            = new EtiketModel();
        $this->satuanModel            = new SatuanModel();
        $this->transaksiModel         = new TransaksiModel();
        $this->detailtransaksiModel   = new DetailTransaksiModel();
        $this->tempModel              = new TempModel();
    }

    public function laporan_harian()
    {
        $data_hari = $this->detailtransaksiModel->getTransaksiPerhari();

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'harian',
            'title'                   => 'Laporan Harian',
            'hari_ini'                  => $data_hari
        ];


        return view('laporan/laporan_harian', $data);
    }

    public function invoice($no_faktur)
    {

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'transaksi',
            'title'                   => 'Invoice',
            'invoice'                 => $this->detailtransaksiModel->getInvoice($no_faktur),
            'detail_transaksi_faktur' => $this->detailtransaksiModel->getDetailFaktur(),
        ];

        if (empty($data['invoice'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($no_faktur . 'tidak ditemukan');
        }

        return view('laporan/invoice', $data);
    }

    public function print($no_faktur)
    {

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'transaksi',
            'title'                   => 'Print Invoice',
            'invoice'                 => $this->detailtransaksiModel->getInvoice($no_faktur),
            'detail_transaksi_faktur' => $this->detailtransaksiModel->getDetailFaktur(),
        ];

        if (empty($data['invoice'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($no_faktur . 'tidak ditemukan');
        }

        return view('laporan/print', $data);
    }

    public function laporan_terlaris()
    {
        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'terlaris',
            'title'                   => 'Laporan Obat Terlaris',
            'data_terlaris'           => $this->detailtransaksiModel->getObatTerlaris(),
        ];
        return view('laporan/obat_terlaris', $data);
    }

    public function laporan_menipis()
    {
        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'menipis',
            'title'                   => 'Laporan Stok Menipis',
            'stok_menipis'           => $this->obatModel->getObat(),
        ];
        return view('laporan/laporan_stok_menipis', $data);
    }

    public function laporan_transaksi()
    {
        $keyword = $this->request->getPost('keyword');
        $order = $this->request->getPost('order');
        $orderTanggal = $this->request->getPost('orderTanggal');

        if ($keyword) {
            $noFaktur = $this->transaksiModel->search($keyword);
        } else {
            $noFaktur = $this->transaksiModel->findAll();
        }

        $namaUser = session()->get('nama_user');

        if ($namaUser) {

            // Sorting by order 'terlama' or 'terbaru'
            if ($order == 'terlama') {
                $noFaktur = $this->transaksiModel->where('nama_kasir', $namaUser)->orderBy('no_faktur', 'ASC')->paginate(5, 'faktur');
            } else {
                $noFaktur = $this->transaksiModel->where('nama_kasir', $namaUser)->orderBy('no_faktur', 'DESC')->paginate(5, 'faktur');
            }
        }

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'transaksi',
            'title'                   => 'Laporan Transaksi',
            'detail_transaksi'        => $this->detailtransaksiModel->getDetailTransaksi(),
            'total'                   => $this->transaksiModel->getGrandTotal($namaUser),
            'transaksi'               => $this->transaksiModel->getTotalTransaksi($namaUser),
            'sub_qty'                 => $queryTotal['total_qty'] ?? 0,
            'detail_transaksi_faktur' => $this->detailtransaksiModel->getDetailFaktur(),
            'faktur'                  => $noFaktur,
            'pager'                   => $this->transaksiModel->pager,
            'order'                   => $order
        ];
        return view('laporan/laporan_transaksi', $data);
    }
}
