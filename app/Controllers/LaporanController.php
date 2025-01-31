<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObatModel;
use App\Models\KategoriModel;
use App\Models\GolonganModel;
use App\Models\SupplierModel;
use App\Models\PabrikModel;
use App\Models\SatuanModel;
use App\Models\EtiketModel;
use App\Models\TransaksiModel;
use App\Models\PembelianModel;
use App\Models\DetailTransaksiModel;
use App\Models\DetailPembelianModel;
use App\Models\TempModel;
use Dompdf\Dompdf;

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
    protected $pembelianModel;
    protected $detailtransaksiModel;
    protected $detailpembelianModel;
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
        $this->pembelianModel         = new PembelianModel();
        $this->detailtransaksiModel   = new DetailTransaksiModel();
        $this->detailpembelianModel   = new DetailPembelianModel();
        $this->tempModel              = new TempModel();
    }

    public function laporan_harian()
    {
        // Get sales data for today
        $hari =  $this->request->getGet('hari') ?? date('Y-m-d');
        $data_hari = $this->detailtransaksiModel->getTransaksiPerhari($hari);

        $sum_total_kotor = $this->transaksiModel->select('SUM(total_kotor) as total_kotor')
            ->where('DATE(tbl_transaksi.tgl_transaksi)', $hari)
            ->get()
            ->getRowArray()['total_kotor'] ?? 0;
        $sum_total_bersih = $this->transaksiModel->select('SUM(total_bersih) as total_bersih')
            ->where('DATE(tbl_transaksi.tgl_transaksi)', $hari)
            ->get()
            ->getRowArray()['total_bersih'] ?? 0;

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'harian',
            'title'                   => 'Laporan Harian | Apotek Sumbersekar',
            'data_hari'               => $data_hari,
            'sum_total_bersih'        => $sum_total_bersih,
            'sum_total_kotor'         => $sum_total_kotor,
            'hari'                    => $hari
        ];

        return view('laporan/laporan_harian', $data);
    }

    public function laporan_bulanan()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');
        $data_bulan = $this->detailtransaksiModel->getTransaksiPerbulan($bulan);

        $sum_total_kotor = $this->transaksiModel->select('SUM(total_kotor) as total_kotor')
            ->where('DATE_FORMAT(tbl_transaksi.tgl_transaksi, "%Y-%m")', $bulan)
            ->get()
            ->getRowArray()['total_kotor'] ?? 0;
        $sum_total_bersih = $this->transaksiModel->select('SUM(total_bersih) as total_bersih')
            ->where('DATE_FORMAT(tbl_transaksi.tgl_transaksi, "%Y-%m")', $bulan)
            ->get()
            ->getRowArray()['total_bersih'] ?? 0;

        $data = [
            'menu'           => 'laporan',
            'submenu'        => 'bulanan',
            'title'          => 'Laporan bulanan | Apotek Sumbersekar',
            'data_bulan'     => $data_bulan,
            'sum_total_kotor'    => $sum_total_kotor,
            'sum_total_bersih'   => $sum_total_bersih,
            'bulan'          => $bulan,
            'data_rekap'     => $this->transaksiModel->select('DATE(tgl_transaksi) as tanggal, SUM(total_bersih) as total_penghasilan')
                ->where('DATE_FORMAT(tgl_transaksi, "%Y-%m")', $bulan)
                ->groupBy('DATE(tgl_transaksi)')
                ->orderBy('tanggal', 'ASC')
                ->get()->getResultArray(),
            'income_per_bulan'  => $this->transaksiModel->select('SUM(total_bersih) as total_perbulan')
                ->where('DATE_FORMAT(tgl_transaksi, "%Y-%m")', $bulan)
                ->get()->getRowArray()['total_perbulan'] ?? 0,


        ];
        return view('laporan/laporan_bulanan', $data);
    }



    public function laporan_tahunan()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $tahun = min((int)$tahun, (int)date('Y'));
        $data_tahun = $this->detailtransaksiModel->getTransaksiPertahun($tahun);

        $sum_total_kotor  = $this->transaksiModel->select('SUM(total_kotor) as total_kotor')
            ->where('YEAR(tgl_transaksi)', $tahun)
            ->get()
            ->getRowArray()['total_kotor'] ?? 0;
        $sum_total_bersih = $this->transaksiModel->select('SUM(total_bersih) as total_bersih')
            ->where('YEAR(tgl_transaksi)', $tahun)
            ->get()
            ->getRowArray()['total_bersih'] ?? 0;

        $data = [
            'menu'               => 'laporan',
            'submenu'            => 'tahunan',
            'title'              => 'Laporan Tahunan | Apotek Sumbersekar',
            'data_tahun'         => $data_tahun,
            'sum_total_kotor'    => $sum_total_kotor,
            'sum_total_bersih'   => $sum_total_bersih,
            'tahun'              => $tahun,
            'data_rekap'         => $this->transaksiModel->select('DATE(tgl_transaksi) as tanggal, SUM(total_bersih) as total_penghasilan')
                ->where('YEAR(tgl_transaksi)', $tahun)
                ->groupBy('DATE(tgl_transaksi)')
                ->orderBy('tanggal', 'ASC')
                ->get()->getResultArray(),
            'income_per_tahun'  => $this->transaksiModel->select('SUM(total_bersih) as total_pertahun')
                ->where('YEAR(tgl_transaksi)', $tahun)
                ->get()->getRowArray()['total_pertahun'] ?? 0,
        ];
        return view('laporan/laporan_tahunan', $data);
    }


    public function invoice($no_faktur)
    {

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'transaksi',
            'title'                   => 'Invoice',
            'invoice'                 => $this->detailtransaksiModel->getInvoice($no_faktur),
            'detail_transaksi_faktur' => $this->detailtransaksiModel->getDetailTransaksi(),
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
            'detail_transaksi_faktur' => $this->detailtransaksiModel->getDetailTransaksi(),
        ];

        if (empty($data['invoice'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($no_faktur . 'tidak ditemukan');
        }

        return view('laporan/print', $data);
    }

    public function laporan_terlaris()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'terlaris',
            'title'                   => 'Laporan Obat Terlaris | Apotek Sumbersekar',
            'data_terlaris'           => $this->detailtransaksiModel->getObatTerlaris($bulan),
            'bulan'                   => $bulan,
        ];
        return view('laporan/obat_terlaris', $data);
    }

    public function laporan_menipis()
    {
        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'menipis',
            'title'                   => 'Laporan Stok Menipis | Apotek Sumbersekar',
            'stok_menipis'            => $this->obatModel->getObat(),
        ];
        return view('laporan/laporan_stok_menipis', $data);
    }

    public function laporan_transaksi()
    {
        date_default_timezone_set('Asia/Jakarta');

        $keyword = $this->request->getPost('keyword');
        $order = $this->request->getPost('order') ?? 'terbaru';
        $periodFilter = $this->request->getPost('period_filter');
        $namaUser = session()->get('nama_user');
        $role = session()->get('role');

        // Set default dates based on period filter
        if ($periodFilter) {
            switch ($periodFilter) {
                case '3_hari':
                    $startDate = date('Y-m-d', strtotime('-3 days'));
                    $endDate = date('Y-m-d');
                    break;
                case '7_hari':
                    $startDate = date('Y-m-d', strtotime('-7 days'));
                    $endDate = date('Y-m-d');
                    break;
                case '1_bulan':
                    $startDate = date('Y-m-d', strtotime('-1 month'));
                    $endDate = date('Y-m-d');
                    break;
                default:
                    $startDate = $this->request->getPost('start_date') ?? date('Y-m-d');
                    $endDate = $this->request->getPost('end_date') ?? date('Y-m-d');
            }
        } else {
            // If no period filter, use custom dates or today's date
            $startDate = $this->request->getPost('start_date') ?? date('Y-m-d');
            $endDate = $this->request->getPost('end_date') ?? date('Y-m-d');
        }

        // Apply search and filtering

        if ($keyword) {
            $noFaktur = $this->transaksiModel->search($keyword, $namaUser, $startDate, $endDate);
        } else {
            $noFaktur = $this->transaksiModel->where('nama_kasir', $namaUser)
                ->where('tgl_transaksi >=', $startDate)
                ->where('tgl_transaksi <=', $endDate);
        }

        // Sorting
        if ($order == 'terlama') {
            $noFaktur = $noFaktur->orderBy('no_faktur', 'ASC');
        } else {
            $noFaktur = $noFaktur->orderBy('no_faktur', 'DESC');
        }

        // Execute query
        $noFaktur = $noFaktur->findAll();

        // Prepare data for view
        $data = [
            'menu'              => 'laporan',
            'submenu'           => 'transaksi',
            'title'            => 'Laporan Transaksi | Apotek Sumbersekar',
            'detail_transaksi' => $this->detailtransaksiModel->getDetailTransaksi(),
            'total'            => $this->transaksiModel->getGrandTotal($namaUser, $startDate, $endDate),
            'transaksi'        => $this->transaksiModel->getTotalTransaksi($namaUser, $startDate, $endDate),
            'sub_qty'          => $queryTotal['total_qty'] ?? 0,
            'faktur'           => $noFaktur,
            'pager'            => $this->transaksiModel->pager,
            'order'            => $order,
            'start_date'       => $startDate,
            'end_date'         => $endDate,
            'keyword'          => $keyword,
            'period_filter'    => $periodFilter
        ];

        return view('laporan/laporan_transaksi', $data);
    }

    public function editTransaksi($no_faktur)
    {
        // Ambil data transaksi berdasarkan no_faktur
        $transaksi = $this->transaksiModel->find($no_faktur);

        // Jika transaksi tidak ditemukan, lemparkan error atau tampilkan pesan
        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi dengan no_faktur $no_faktur tidak ditemukan.");
        }

        // Ambil detail transaksi berdasarkan no_faktur
        $detail_transaksi = $this->detailtransaksiModel->getDetailFaktur($no_faktur);

        // Data yang akan dikirim ke view
        $data = [
            'menu'             => 'laporan',
            'submenu'          => 'harian',
            'title'            => 'Edit Transaksi | Apotek Sumbersekar',
            'transaksi'        => $transaksi,
            'detail_transaksi' => $detail_transaksi,
        ];

        return \view('laporan/edit_transaksi', $data);
    }

    public function edit_detail_transaksi($id)
    {
        if ($this->request->isAJAX()) {
            $ambildata             = $this->detailtransaksiModel->find($id);
            $obat                  = $this->obatModel->find($ambildata['id_obat']);
            $kategori              = $this->kategoriModel->find($obat['id_kategori']);
            $satuan                = $this->satuanModel->find($obat['id_satuan']);

            $no_faktur             = $this->request->getVar('no_faktur');
            $tanggal               = $this->request->getVar('tanggal');
            $jam                   = $this->request->getVar('jam');
            $nama_kasir            = $this->request->getVar('nama_kasir');

            $diskon_persen         = str_replace([',', '.'], '', $this->request->getVar('diskon_persen'));
            $diskon_uang           = str_replace([',', '.'], '', $this->request->getVar('diskon_uang'));
            $total_kotor           = str_replace([',', '.'], '', $this->request->getVar('total_kotor'));
            $total_bersih          = str_replace([',', '.'], '', $this->request->getVar('total_bersih'));
            $jumlah_uang           = str_replace([',', '.'], '', $this->request->getVar('jumlah_uang'));
            $sisa_uang             = str_replace([',', '.'], '', $this->request->getVar('sisa_uang'));

            $data = [
                'detail'           => $ambildata,
                'obat'             => $obat,
                'kategori'         => $kategori,
                'satuan'           => $satuan,
                'no_faktur'        => $no_faktur,
                'tanggal'          => $tanggal,
                'jam'              => $jam,
                'nama_kasir'       => $nama_kasir,
                'diskon_persen'    => $diskon_persen,
                'diskon_uang'      => $diskon_uang,
                'total_kotor'      => $total_kotor,
                'total_bersih'     => $total_bersih,
                'jumlah_uang'      => $jumlah_uang,
                'sisa_uang'        => $sisa_uang,
            ];

            $msg = [
                'data' => view('laporan/modal_edit_transaksi', $data),
            ];
            return $this->response->setJSON($msg);
        }
    }

    public function simpanTransaksi()
    {
        if ($this->request->isAJAX()) {
            $detail_transaksi_id = $this->request->getVar('detail_transaksi_id');
            $no_faktur           = $this->request->getVar('no_faktur');
            $id_obat             = $this->request->getVar('id_obat');
            $nama_obat           = $this->request->getVar('nama_obat');
            $harga_pokok         = $this->request->getVar('harga_pokok');
            $harga_jual          = str_replace([',', '.'], '', $this->request->getVar('harga_jual'));
            $qty                 = str_replace([',', '.'], '', $this->request->getVar('qty'));
            $sub_total           = str_replace([',', '.'], '', $this->request->getVar('sub_total'));

            $tanggal             = $this->request->getVar('tanggal');
            $jam                 = $this->request->getVar('jam');
            $nama_kasir          = $this->request->getVar('nama_kasir');
            $diskon_persen       = \intval(str_replace([',', '.'], '', $this->request->getVar('diskon_persen')));
            $diskon_uang         = \intval(str_replace([',', '.'], '', $this->request->getVar('diskon_uang')));
            $jumlah_uang         = \intval(str_replace([',', '.'], '', $this->request->getVar('jumlah_uang')));



            $queryCekObat = $this->obatModel
                ->where('nama_obat', $nama_obat)
                ->orwhere('barcode_obat', $nama_obat)
                ->orwhere('kode_rak', $nama_obat)
                ->get();

            $rowObat = $queryCekObat->getRowArray();
            $stokObat = $rowObat['stok_obat'];

            if (\intval($stokObat) == 0) {
                $msg = [
                    'error' => 'Maaf stok Habis...'
                ];
            } elseif ($qty > \intval($stokObat)) {
                $msg = [
                    'error' => 'Maaf stok tidak cukup'
                ];
            } else {
                $updateDataDetailTransaksi = [
                    'detail_transaksi_id' => $detail_transaksi_id,
                    'no_faktur'           => $no_faktur,
                    'id_obat'             => $id_obat,
                    'harga_pokok'         => $harga_pokok,
                    'harga_jual'          => $harga_jual,
                    'qty'                 => $qty,
                    'sub_total'           => $sub_total,
                ];

                $this->detailtransaksiModel->update($detail_transaksi_id, $updateDataDetailTransaksi);
            }


            $queryTotal = $this->detailtransaksiModel->select('SUM(sub_total) as sub_total')->where('no_faktur', $no_faktur)->get();
            $rowTotal = $queryTotal->getRowArray();

            $hasilTotalBersih = intval($rowTotal['sub_total']) - (intval($rowTotal['sub_total']) * $diskon_persen / 100) - $diskon_uang;
            $hasilSisaUang    = \intval($jumlah_uang - $hasilTotalBersih);

            if (\intval($stokObat) == 0) {
                $msg = [
                    'error' => 'Maaf stok Habis...'
                ];
            } elseif ($qty > \intval($stokObat)) {
                $msg = [
                    'error' => 'Maaf stok tidak cukup'
                ];
            } else {
                $updateDataTransaksi = [
                    'no_faktur'        => $no_faktur,
                    'tanggal'          => $tanggal,
                    'jam'              => $jam,
                    'nama_kasir'       => $nama_kasir,
                    'diskon_persen'    => $diskon_persen,
                    'diskon_uang'      => $diskon_uang,
                    'total_kotor'      => $rowTotal['sub_total'],
                    'total_bersih'     => $hasilTotalBersih,
                    'jumlah_uang'      => $jumlah_uang,
                    'sisa_uang'        => $hasilSisaUang,
                ];

                $this->transaksiModel->update($no_faktur, $updateDataTransaksi);
            }



            $msg = ['success' => 'berhasil'];

            return $this->response->setJSON($msg);
        }
    }

    public function hapusTransaksi()
    {
        if ($this->request->isAJAX()) {
            $no_faktur = $this->request->getVar('no_faktur');

            // Hapus detail transaksi terlebih dahulu karena ini adalah child table
            $deleteDetailTransaksi = $this->detailtransaksiModel->where('no_faktur', $no_faktur)->delete();

            // Kemudian hapus transaksi utama
            $deleteTransaksi = $this->transaksiModel->where('no_faktur', $no_faktur)->delete();

            if ($deleteDetailTransaksi && $deleteTransaksi) {
                $msg = [
                    'success' => 'berhasil'
                ];
                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'error' => 'gagal menghapus data'
                ];
                return $this->response->setJSON($msg);
            }
        }
    }

    public function laporan_pembelian()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');
        $data_bulan = $this->detailpembelianModel->getPembelianPerbulan($bulan);

        $total_pembelian = $this->pembelianModel->select('SUM(total_pembelian) as total_pembelian')
            ->where('DATE_FORMAT(tgl_pembelian, "%Y-%m")', $bulan)
            ->get()
            ->getRowArray()['total_pembelian'] ?? 0;


        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'pembelian',
            'title'                   => 'Laporan Pembelian | Apotek Sumbersekar',
            'data_bulan'              => $data_bulan,
            'total_pembelian'         => $total_pembelian,
            'bulan'                   => $bulan
        ];
        return view('laporan/laporan_pembelian', $data);
    }

    public function editPembelian($id_pembelian)
    {
        $pembelian = $this->pembelianModel->find($id_pembelian);
        $supplier  = $this->supplierModel->find($pembelian['id_supplier']);

        if (!$pembelian) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pembelian dengan id pembelian $id_pembelian tidak ditemukan.");
        }

        $detail_pembelian = $this->detailpembelianModel->getDetailPembelian($id_pembelian);

        // Data yang akan dikirim ke view
        $data = [
            'menu'             => 'laporan',
            'submenu'          => 'pembelian',
            'title'            => 'Edit Pembelian | Apotek Sumbersekar',
            'pembelian'        => $pembelian,
            'detail_pembelian' => $detail_pembelian,
            'supplier'         => $supplier
        ];

        return \view('laporan/edit_pembelian', $data);
    }

    public function edit_detail_pembelian($id)
    {
        if ($this->request->isAJAX()) {
            $ambildata                 = $this->detailpembelianModel->find($id);
            $obat                      = $this->obatModel->find($ambildata['id_obat']);
            $kategori                  = $this->kategoriModel->find($obat['id_kategori']);
            $satuan                    = $this->satuanModel->find($obat['id_satuan']);

            $id_pembelian              = $this->request->getVar('id_pembelian');
            $supplier                  = $this->request->getVar('id_supplier');
            $tgl_pembelian             = $this->request->getVar('tgl_pembelian');
            $no_faktur                 = $this->request->getVar('no_faktur');
            $deskripsi                 = $this->request->getVar('deskripsi');

            $total_pembelian           = str_replace([',', '.'], '', $this->request->getVar('total_pembelian'));


            $data = [
                'detail'              => $ambildata,
                'id_pembelian'        => $id_pembelian,
                'supplier'            => $supplier,
                'obat'                => $obat,
                'kategori'            => $kategori,
                'satuan'              => $satuan,
                'supplier'            => $supplier,
                'no_faktur'           => $no_faktur,
                'tgl_pembelian'       => $tgl_pembelian,
                'deskripsi'           => $deskripsi,
                'total_pembelian'     => $total_pembelian,
            ];

            $msg = [
                'data' => view('laporan/modal_edit_pembelian', $data),
            ];
            return $this->response->setJSON($msg);
        }
    }

    public function updatePembelian()
    {
        if ($this->request->isAJAX()) {
            $detail_pembelian_id          = $this->request->getVar('detail_pembelian_id');
            $id_obat                      = $this->request->getVar('id_obat');
            $harga_pokok                  = str_replace([',', '.'], '', $this->request->getVar('harga_pokok'));
            $qty                          = str_replace([',', '.'], '', $this->request->getVar('qty'));
            $sub_total                    = str_replace([',', '.'], '', $this->request->getVar('sub_total'));

            $id_pembelian                 = $this->request->getVar('id_pembelian');
            $tgl_pembelian                = $this->request->getVar('tgl_pembelian');
            $no_faktur                    = $this->request->getVar('no_faktur');
            $deskripsi                    = $this->request->getVar('deskripsi');

            $updateDataDetailPembelian = [
                'detail_pembelian_id'    => $detail_pembelian_id,
                'id_pembelian'           => $id_pembelian,
                'id_obat'                => $id_obat,
                'harga_pokok'            => $harga_pokok,
                'qty'                    => $qty,
                'sub_total'              => $sub_total,
            ];

            $this->detailpembelianModel->update($detail_pembelian_id, $updateDataDetailPembelian);



            $queryTotal = $this->detailpembelianModel->select('SUM(sub_total) as total_pembelian')->where('id_pembelian', $id_pembelian)->get();
            $rowTotal = $queryTotal->getRowArray();

            $updateDataPembelian = [
                'id_pembelian'           => $id_pembelian,
                'tgl_pembelian'          => $tgl_pembelian,
                'no_faktur'              => $no_faktur,
                'total_pembelian'        => $rowTotal['total_pembelian'],
                'deskripsi'              => $deskripsi,
            ];

            $this->pembelianModel->update($id_pembelian, $updateDataPembelian);


            $msg = ['success' => 'berhasil'];

            return $this->response->setJSON($msg);
        }
    }

    public function hapusPembelian()
    {
        if ($this->request->isAJAX()) {
            $id_pembelian = $this->request->getVar('id_pembelian');

            // Hapus detail transaksi terlebih dahulu karena ini adalah child table
            $deleteDetailPembelian = $this->detailpembelianModel->where('id_pembelian', $id_pembelian)->delete();

            // Kemudian hapus transaksi utama
            $deletePembelian = $this->pembelianModel->where('id_pembelian', $id_pembelian)->delete();

            if ($deleteDetailPembelian && $deletePembelian) {
                $msg = [
                    'success' => 'berhasil'
                ];
                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'error' => 'gagal menghapus data'
                ];
                return $this->response->setJSON($msg);
            }
        }
    }

    // In your controller
    public function exportpdf_bulanan()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');
        $data = [
            'data_rekap'       => $this->transaksiModel->select('DATE(tgl_transaksi) as tanggal, SUM(total_bersih) as total_penghasilan')
                ->where('DATE_FORMAT(tgl_transaksi, "%Y-%m")', $bulan)
                ->groupBy('DATE(tgl_transaksi)')
                ->orderBy('tanggal', 'ASC')
                ->get()->getResultArray(),

            'income_per_bulan'  => $this->transaksiModel->select('SUM(total_bersih) as total_perbulan')
                ->where('DATE_FORMAT(tgl_transaksi, "%Y-%m")', $bulan)
                ->get()->getRowArray()['total_perbulan'] ?? 0,
            'bulan' => $bulan
        ];

        $filename = 'Laporan Pendapatan Bulanan - ' . date('F Y', strtotime($bulan));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan/exportpdf_bulanan', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }

    // In your controller
    public function exportpdf_tahunan()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $tahun = min((int)$tahun, (int)date('Y'));
        $data = [
            'data_rekap'   => $this->transaksiModel->select('DATE(tgl_transaksi) as tanggal, SUM(total_bersih) as total_penghasilan')
                ->where('YEAR(tgl_transaksi)', $tahun)
                ->groupBy('DATE(tgl_transaksi)')
                ->orderBy('tanggal', 'ASC')
                ->get()->getResultArray(),
            'income_per_tahun'  => $this->transaksiModel->select('SUM(total_bersih) as total_pertahun')
                ->where('YEAR(tgl_transaksi)', $tahun)
                ->get()->getRowArray()['total_pertahun'] ?? 0,
            'tahun' => $tahun
        ];

        $filename = 'Laporan Pendapatan Tahunan - ' . $tahun;

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan/exportpdf_tahunan', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}
