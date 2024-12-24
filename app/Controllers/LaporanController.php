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
use App\Models\PembelianModel;
use App\Models\DetailTransaksiModel;
use App\Models\DetailPembelianModel;
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

        // Group data by unique criteria
        $grouped_data = [];
        $total_penjualan = 0;
        $total_qty = 0;
        $total_diskon_uang = 0;
        $total_diskon_persen = 0;

        foreach ($data_hari as $item) {
            $key = $item['no_faktur'];

            if (!isset($grouped_data[$key])) {
                $grouped_data[$key] = [
                    'no_faktur' => $item['no_faktur'],
                    'tgl_transaksi' => $item['tgl_transaksi'],
                    'items' => [],
                    'total_penjualan' => 0,
                    'total_qty' => 0,
                    // PENTING: Gunakan diskon yang ada di transaksi, bukan diakumulasi
                    'diskon_uang' => $item['diskon_uang'],
                    'diskon_persen' => $item['diskon_persen']
                ];
            }

            // Tambahkan item ke transaksi
            $grouped_data[$key]['items'][] = [
                'nama_obat' => $item['nama_obat'],
                'kode_rak' => $item['kode_rak'],
                'barcode_obat' => $item['barcode_obat'],
                'nama_satuan' => $item['nama_satuan'],
                'nama_kategori' => $item['nama_kategori'],
                'harga_jual' => $item['harga_jual'],
                'total_qty' => $item['total_qty'],
                'total_penjualan' => $item['total_penjualan']
            ];

            // Update transaction totals
            $grouped_data[$key]['total_penjualan'] += $item['total_penjualan'] - ($item['total_penjualan'] * $item['diskon_persen'] / 100) - $item['diskon_uang'];
            $grouped_data[$key]['total_qty'] += $item['total_qty'];

            // Update overall totals - HATI-HATI dengan penjumlahan
            $total_penjualan += $item['total_penjualan'] - ($item['total_penjualan'] * $item['diskon_persen'] / 100) - $item['diskon_uang'];
            $total_qty += $item['total_qty'];
        }

        // Hitung total diskon uang dan persen hanya sekali per transaksi
        foreach ($grouped_data as $transaksi) {
            $total_diskon_uang += $transaksi['diskon_uang'];
            $total_diskon_persen += $transaksi['diskon_persen'];
        }

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'harian',
            'title'                   => 'Laporan Harian | Apotek Sumbersekar',
            'data_hari'                => $grouped_data,
            'total_penjualan'         => $total_penjualan,
            'total_qty'               => $total_qty,
            'diskon_uang'             => $total_diskon_uang,
            'diskon_persen'           => $total_diskon_persen,
            'hari'                    => $hari
        ];

        return view('laporan/laporan_harian', $data);
    }

    public function laporan_bulanan()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');
        $data_bulan = $this->detailtransaksiModel->getTransaksiPerbulan($bulan);

        // Group data by transaction number and calculate totals
        $grouped_data = [];
        $total_penjualan = 0;
        $total_qty = 0;
        $total_diskon_uang = 0;
        $total_diskon_persen = 0;

        foreach ($data_bulan as $item) {
            $key = $item['no_faktur'];

            if (!isset($grouped_data[$key])) {
                $grouped_data[$key] = [
                    'no_faktur' => $item['no_faktur'],
                    'tgl_transaksi' => $item['tgl_transaksi'],
                    'items' => [],
                    'total_penjualan' => 0,
                    'total_qty' => 0,
                    'diskon_uang' => $item['diskon_uang'],
                    'diskon_persen' => $item['diskon_persen']
                ];
            }

            // Tambahkan item ke transaksi
            $grouped_data[$key]['items'][] = [
                'nama_obat' => $item['nama_obat'],
                'kode_rak' => $item['kode_rak'],
                'barcode_obat' => $item['barcode_obat'],
                'nama_kategori' => $item['nama_kategori'],
                'nama_satuan' => $item['nama_satuan'],
                'harga_jual' => $item['harga_jual'],
                'total_qty' => $item['total_qty'],
                'total_penjualan' => $item['total_penjualan']
            ];

            // Update transaction totals
            $grouped_data[$key]['total_penjualan'] += $item['total_penjualan'] - ($item['total_penjualan'] * $item['diskon_persen'] / 100) - $item['diskon_uang'];
            $grouped_data[$key]['total_qty'] += $item['total_qty'];

            // Update overall totals
            $total_penjualan += $item['total_penjualan'] - ($item['total_penjualan'] * $item['diskon_persen'] / 100) - $item['diskon_uang'];
            $total_qty += $item['total_qty'];
        }


        // Hitung total diskon uang dan persen hanya sekali per transaksi
        foreach ($grouped_data as $transaksi) {
            $total_diskon_uang += $transaksi['diskon_uang'];
            $total_diskon_persen += $transaksi['diskon_persen'];
        }

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'bulanan',
            'title'                   => 'Laporan Bulanan | Apotek Sumbersekar',
            'data_bulan'              => $grouped_data,
            'total_penjualan'         => $total_penjualan,
            'total_qty'               => $total_qty,
            'total_diskon_uang'       => $total_diskon_uang,
            'total_diskon_persen'     => $total_diskon_persen,
            'bulan'                   => $bulan
        ];
        return view('laporan/laporan_bulanan', $data);
    }

    public function laporan_tahunan()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $data_tahun = $this->detailtransaksiModel->getTransaksiPertahun($tahun);

        // Group data by transaction number and calculate totals
        $grouped_data = [];
        $total_penjualan = 0;
        $total_qty = 0;
        $total_diskon_uang = 0;
        $total_diskon_persen = 0;

        foreach ($data_tahun as $item) {
            $key = $item['no_faktur'];

            if (!isset($grouped_data[$key])) {
                $grouped_data[$key] = [
                    'no_faktur' => $item['no_faktur'],
                    'tgl_transaksi' => $item['tgl_transaksi'],
                    'items' => [],
                    'total_penjualan' => 0,
                    'total_qty' => 0,
                    'diskon_uang' => $item['diskon_uang'],
                    'diskon_persen' => $item['diskon_persen']
                ];
            }

            // Tambahkan item ke transaksi
            $grouped_data[$key]['items'][] = [
                'nama_obat' => $item['nama_obat'],
                'kode_rak' => $item['kode_rak'],
                'barcode_obat' => $item['barcode_obat'],
                'nama_kategori' => $item['nama_kategori'],
                'nama_satuan' => $item['nama_satuan'],
                'harga_jual' => $item['harga_jual'],
                'total_qty' => $item['total_qty'],
                'total_penjualan' => $item['total_penjualan']
            ];

            // Update transaction totals
            $grouped_data[$key]['total_penjualan'] += $item['total_penjualan'] - ($item['total_penjualan'] * $item['diskon_persen'] / 100) - $item['diskon_uang'];
            $grouped_data[$key]['total_qty'] += $item['total_qty'];

            // Update overall totals
            $total_penjualan += $item['total_penjualan'] - ($item['total_penjualan'] * $item['diskon_persen'] / 100) - $item['diskon_uang'];
            $total_qty += $item['total_qty'];
        }

        // Hitung total diskon uang dan persen hanya sekali per transaksi
        foreach ($grouped_data as $transaksi) {
            $total_diskon_uang += $transaksi['diskon_uang'];
            $total_diskon_persen += $transaksi['diskon_persen'];
        }

        $data = [
            'menu' => 'laporan',
            'submenu' => 'tahunan',
            'title' => 'Laporan Tahunan | Apotek Sumbersekar',
            'data_tahun' => $grouped_data,
            'total_penjualan' => $total_penjualan,
            'total_qty' => $total_qty,
            'total_diskon_uang' => $total_diskon_uang,
            'total_diskon_persen' => $total_diskon_persen,
            'tahun' => $tahun
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
            'stok_menipis'           => $this->obatModel->getObat(),
        ];
        return view('laporan/laporan_stok_menipis', $data);
    }

    public function laporan_transaksi()
    {
        $keyword = $this->request->getPost('keyword');
        $order = $this->request->getPost('order') ?? 'terbaru';

        // Secara default gunakan tanggal hari ini
        $startDate = $this->request->getPost('start_date') ?? date('Y-m-d');
        $endDate = $this->request->getPost('end_date') ?? date('Y-m-d');

        $namaUser = session()->get('nama_user');

        // Apply search and filtering
        if ($keyword) {
            $noFaktur = $this->transaksiModel->search($keyword, $namaUser, $startDate, $endDate);
        } else {
            $noFaktur = $this->transaksiModel->where('nama_kasir', $namaUser);

            // Tambahkan filter tanggal
            $noFaktur = $noFaktur->where('tgl_transaksi >=', $startDate)
                ->where('tgl_transaksi <=', $endDate);
        }

        // Sorting
        if ($order == 'terlama') {
            $noFaktur = $noFaktur->orderBy('no_faktur', 'ASC');
        } else {
            $noFaktur = $noFaktur->orderBy('no_faktur', 'DESC');
        }

        // Pagination
        $noFaktur = $noFaktur->findAll();

        // Prepare data for view
        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'transaksi',
            'title'                   => 'Laporan Transaksi | Apotek Sumbersekar',
            'detail_transaksi'        => $this->detailtransaksiModel->getDetailTransaksi(),
            'total'                   => $this->transaksiModel->getGrandTotal($namaUser, $startDate, $endDate),
            'transaksi'               => $this->transaksiModel->getTotalTransaksi($namaUser, $startDate, $endDate),
            'sub_qty'                 => $queryTotal['total_qty'] ?? 0,
            'faktur'                  => $noFaktur,
            'pager'                   => $this->transaksiModel->pager,
            'order'                   => $order,
            'start_date'              => $startDate,
            'end_date'                => $endDate,
            'keyword'                 => $keyword
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
            $ambildata = $this->detailtransaksiModel->find($id);
            $obat = $this->obatModel->find($ambildata['id_obat']);
            $kategori = $this->kategoriModel->find($obat['id_kategori']);
            $satuan = $this->satuanModel->find($obat['id_satuan']);

            $no_faktur           = $this->request->getVar('no_faktur');
            $tanggal             = $this->request->getVar('tanggal');
            $jam                 = $this->request->getVar('jam');
            $nama_kasir          = $this->request->getVar('nama_kasir');

            $diskon_persen       = str_replace([',', '.'], '', $this->request->getVar('diskon_persen'));
            $diskon_uang         = str_replace([',', '.'], '', $this->request->getVar('diskon_uang'));
            $total_kotor         = str_replace([',', '.'], '', $this->request->getVar('total_kotor'));
            $total_bersih        = str_replace([',', '.'], '', $this->request->getVar('total_bersih'));
            $jumlah_uang         = str_replace([',', '.'], '', $this->request->getVar('jumlah_uang'));
            $sisa_uang           = str_replace([',', '.'], '', $this->request->getVar('sisa_uang'));

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
            $nama_obat             = $this->request->getVar('nama_obat');
            $harga_pokok         = $this->request->getVar('harga_pokok');
            $harga_jual          = str_replace([',', '.'], '', $this->request->getVar('harga_jual'));
            $qty                 = str_replace([',', '.'], '', $this->request->getVar('qty'));
            $sub_total           = str_replace([',', '.'], '', $this->request->getVar('sub_total'));

            $tanggal             = $this->request->getVar('tanggal');
            $jam                 = $this->request->getVar('jam');
            $nama_kasir          = $this->request->getVar('nama_kasir');
            $diskon_persen       = \intval(str_replace([',', '.'], '', $this->request->getVar('diskon_persen')));
            $diskon_uang         = \intval(str_replace([',', '.'], '', $this->request->getVar('diskon_uang')));
            $total_kotor         = \intval(str_replace([',', '.'], '', $this->request->getVar('total_kotor')));
            $total_bersih        = str_replace([',', '.'], '', $this->request->getVar('total_bersih'));
            $jumlah_uang         = \intval(str_replace([',', '.'], '', $this->request->getVar('jumlah_uang')));
            $sisa_uang           = \intval(str_replace([',', '.'], '', $this->request->getVar('sisa_uang')));



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

        // Group data by transaction number and calculate totals
        $grouped_data      = [];
        $total_pembelian   = 0;
        $total_qty         = 0;

        foreach ($data_bulan as $item) {
            $key = $item['id_pembelian'];

            if (!isset($grouped_data[$key])) {
                $grouped_data[$key] = [
                    'id_pembelian'       => $item['id_pembelian'],
                    'tgl_pembelian'      => $item['tgl_pembelian'],
                    'items'              => [],
                    'total_pembelian'    => 0,
                    'total_qty'          => 0,
                ];
            }

            // Tambahkan item ke transaksi
            $grouped_data[$key]['items'][] = [
                'nama_obat'          => $item['nama_obat'],
                'kode_rak'           => $item['kode_rak'],
                'barcode_obat'       => $item['barcode_obat'],
                'nama_kategori'      => $item['nama_kategori'],
                'nama_supplier'      => $item['nama_supplier'],
                'nama_satuan'        => $item['nama_satuan'],
                'harga_pokok'        => $item['harga_pokok'],
                'total_qty'          => $item['total_qty'],
                'total_pembelian'    => $item['total_pembelian']
            ];

            // Update transaction totals
            $grouped_data[$key]['total_pembelian'] += $item['total_pembelian'];
            $grouped_data[$key]['total_qty'] += $item['total_qty'];

            // Update overall totals
            $total_pembelian += $item['total_pembelian'];
            $total_qty += $item['total_qty'];
        }

        $data = [
            'menu'                    => 'laporan',
            'submenu'                 => 'pembelian',
            'title'                   => 'Laporan Pembelian | Apotek Sumbersekar',
            'data_bulan'              => $grouped_data,
            'total_pembelian'         => $total_pembelian,
            'total_qty'               => $total_qty,
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
            $detail_pembelian_id       = $this->request->getVar('detail_pembelian_id');
            $id_obat                   = $this->request->getVar('id_obat');
            $harga_pokok               = str_replace([',', '.'], '', $this->request->getVar('harga_pokok'));
            $qty                       = str_replace([',', '.'], '', $this->request->getVar('qty'));
            $sub_total                 = str_replace([',', '.'], '', $this->request->getVar('sub_total'));

            $id_pembelian              = $this->request->getVar('id_pembelian');
            $supplier                  = $this->request->getVar('id_supplier');
            $tgl_pembelian             = $this->request->getVar('tgl_pembelian');
            $total_pembelian           = str_replace([',', '.'], '', $this->request->getVar('total_pembelian'));
            $no_faktur                 = $this->request->getVar('no_faktur');
            $deskripsi                 = $this->request->getVar('deskripsi');

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
}
