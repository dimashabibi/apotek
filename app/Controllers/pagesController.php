<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObatModel;
use App\Models\DataObatModel;
use App\Models\KategoriModel;
use App\Models\GolonganModel;
use App\Models\SupplierModel;
use App\Models\PabrikModel;
use App\Models\SatuanModel;
use App\Models\EtiketModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\HutangModel;
use App\Models\TempModel;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

use CodeIgniter\Config\Services as ConfigServices;
use Config\Services;
use PHPUnit\Util\Json;


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
    protected $detailtransaksiModel;
    protected $tempModel;
    protected $hutangModel;

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
        $this->hutangModel            = new HutangModel();
    }

    // ------------------------------------------------------------------------- Home Controller
    public function home()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');
        $data = [
            'title'             => 'Dashboard | Apotek Sumbersekar',
            'menu'              => 'dashboard',
            'submenu'           => '',
            'total_obat'        => $this->obatModel->countAllResults(),
            'stok_menipis'      => $this->obatModel->where('stok_obat <= stok_min')->countAllResults(),
            'stok_habis'        => $this->obatModel->where('stok_obat', null)->countAllResults(),
            'total_hutang'      => $this->hutangModel
                ->select('SUM(total_hutang) as total_hutang')
                ->where('is_paid', 0)
                ->first()['total_hutang'] ?? 0,
            'income_per_hari'   => $this->transaksiModel->getTransaksiPerhari(),
            'income_per_bulan'  => $this->transaksiModel->getTransaksiPerbulan(),
            'income_per_tahun'  => $this->transaksiModel->getTransaksiPertahun(),
            'obat'              => $this->obatModel->getObat(),
            'data_kategori'     => $this->detailtransaksiModel->getKategoriObat(),
            'data_transaksi'    => $this->detailtransaksiModel->getDataTransaksi(),
            'data_terlaris'     => $this->detailtransaksiModel->getObatTerlaris($bulan),
        ];
        return view('pages/home', $data);
    }

    // ------------------------------------------------------------------------- KAsir Controller
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
    // kasir page end

    // ------------------------------------------------------------------------- Cek Obat Controller
    public function cekObat()
    {
        if ($this->request->isAJAX()) {

            $keyword = $this->request->getPost('keyword');

            $data = [
                'keyword' => $keyword
            ];
            $msg = [
                'viewmodal' => view('item/view_cariproduk', $data)
            ];
            return $this->response->setJSON($msg);
        }
    }
    // cek obat end

    // ------------------------------------------------------------------------- Data Detail Controller
    public function dataDetail()
    {
        if ($this->request->isAJAX()) {
            $no_faktur = $this->request->getVar('no_faktur');
            $detail    = $this->tempModel->getTemp($no_faktur);

            $data = [
                'datadetail' => $detail
            ];
            $msg = [
                'data' => view('item/view_detail', $data)
            ];

            return $this->response->setJSON($msg);
        }
    }
    // Data Detail End

    // ------------------------------------------------------------------------- List Obat Controller
    public function listDataObat()
    {
        if ($this->request->isAJAX()) {
            $keywordbarcode = $this->request->getVar('keywordbarcode');
            $request = Services::request();
            $modelObat = new DataObatModel($request);

            if ($request->getMethod(true) === 'POST') {
                $lists = $modelObat->getDataTables($keywordbarcode);
                $data  = [];
                $no    = $request->getPost('start');

                foreach ($lists as $list) {
                    $no++;
                    $row    = [];
                    $row[]  = $no;
                    $row[]  = $list->kode_rak;
                    $row[]  = $list->barcode_obat;
                    $row[]  = $list->nama_obat;
                    $row[]  = $list->nama_kategori;
                    $row[]  = $list->nama_satuan;
                    $row[]  = number_format($list->stok_obat);
                    $row[]  = number_format($list->harga_jual, 0, ",", ".");
                    $row[]  = "<button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"pilihitem('" . $list->kode_rak . "','" . $list->barcode_obat . "','" . $list->nama_obat . "','" . $list->nama_kategori . "','" . $list->nama_satuan . "','" . "Rp" . " " . \number_format($list->harga_jual, 0, ",", ".")  . "')\">Pilih</button>";
                    $data[] = $row;
                }

                $output = [
                    'draw'            => $request->getPost('draw'),
                    'recordsTotal'    => $modelObat->countAll($keywordbarcode),
                    'recordsFiltered' => $modelObat->countFiltered($keywordbarcode),
                    'data' => $data
                ];

                return $this->response->setJSON($output);
            }
        }
    }
    // List Data Obat End

    // ------------------------------------------------------------------------- Simpan Temp Controller
    public function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $barcode_obat  = $this->request->getVar('barcode_obat');
            $nama_obat     = $this->request->getVar('nama_obat');
            $qty           = $this->request->getVar('qty');
            $no_faktur     = $this->request->getVar('no_faktur');
            $kode_rak      = $this->request->getVar('kode_rak');


            $queryCekObat = $this->obatModel
                ->where('nama_obat', $nama_obat)
                ->orwhere('barcode_obat', $nama_obat)
                ->orwhere('kode_rak', $nama_obat)
                ->get();

            $totalData    = $queryCekObat->getNumRows();

            if ($totalData == 1) {
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
                    $tempObat = $this->tempModel
                        ->where('no_faktur', $no_faktur)
                        ->where('id_obat', $rowObat['id'])
                        ->first();
                    if ($tempObat) {
                        // Jika obat sudah ada, tambahkan qty
                        $newQty = $tempObat['qty'] + $qty;
                        $updateData = [
                            'no_faktur'   => $no_faktur,
                            'id_obat'     => $rowObat['id'],
                            'harga_pokok' => $rowObat['harga_pokok'],
                            'harga_jual'  => $rowObat['harga_jual'],
                            'qty'         => $newQty,
                            'sub_total'   => intval($rowObat['harga_jual'] * $newQty)
                        ];
                        $this->tempModel->update($tempObat['detail_transaksi_id'], $updateData);
                    } else {
                        // Jika obat belum ada, insert data baru
                        $insertData = [
                            'no_faktur'   => $no_faktur,
                            'id_obat'     => $rowObat['id'],
                            'harga_pokok' => $rowObat['harga_pokok'],
                            'harga_jual'  => $rowObat['harga_jual'],
                            'qty'         => $qty,
                            'sub_total'   => intval($rowObat['harga_jual'] * $qty)
                        ];
                        $this->tempModel->insert($insertData);
                    }

                    $msg = ['success' => 'berhasil'];
                }
            } else {
                $msg = [
                    'error' => 'Maaf obat tidak terdaftar'
                ];
            }

            return $this->response->setJSON($msg);
        }
    }


    // ------------------------------------------------------------------------- Hitung Total Controller
    public function hitungTotalBayar()
    {
        if ($this->request->isAJAX()) {
            $no_faktur    = $this->request->getVar('no_faktur');

            $queryTotal = $this->tempModel->select('SUM(sub_total) as total_bayar')->where('no_faktur', $no_faktur)->get();

            $rowTotal = $queryTotal->getRowArray();

            $msg = [
                'totalbayar' => "Rp" . " " . " " . number_format($rowTotal['total_bayar'], 0, ",", ".")
            ];
            return $this->response->setJSON($msg);
        }
    }
    // hitung total end

    // ------------------------------------------------------------------------- Hapus Item Controller
    public function hapusItem() 
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $hapusitem = $this->tempModel->where('detail_transaksi_id', $id)->delete();

            if ($hapusitem) {
                $msg = [
                    'success' => 'berhasil'
                ];
                return $this->response->setJSON($msg);
            }
        }
    }
    // end Hapus Item

    // ------------------------------------------------------------------------- Batal Transaksi Controller
    public function batalTransaksi()
    {
        if ($this->request->isAJAX()) {
            $no_faktur    = $this->request->getVar('no_faktur');

            $hapusTable   =  $this->tempModel->emptyTable();

            if ($hapusTable) {
                $msg = [
                    'success' => 'berhasil'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }
    // end batal Transaksi

    // ------------------------------------------------------------------------- Modal Pembayaran Controller
    public function pembayaran()
    {

        if ($this->request->isAJAX()) {
            $no_faktur       = $this->request->getVar('no_faktur');
            $jamTransaksi    = $this->request->getVar('jamTransaksi');
            $namaKasir       = $this->request->getVar('namaKasir');

            $cekDataTemp = $this->tempModel->where(['no_faktur' => $no_faktur])->get();

            $queryTotal  = $this->tempModel->select('SUM(sub_total) as total_bayar')->where('no_faktur', $no_faktur)->get();

            $rowTotal    = $queryTotal->getRowArray();

            date_default_timezone_set('Asia/Jakarta');

            if ($cekDataTemp->getNumRows() > 0) {
                $data = [
                    'no_faktur'     => $no_faktur,
                    'tgl_transaksi' => \date('Y-m-d'),
                    'jam'           => $jamTransaksi,
                    'nama_kasir'    => $namaKasir,
                    'total_bayar'   => $rowTotal['total_bayar']
                ];
                $msg = [
                    'data' => view('item/modal_pembayaran', $data)
                ];
            } else {
                $msg = [
                    'error' => 'Maaf item belum diinput...'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }
    // Modal Pembayaran End

    // ------------------------------------------------------------------------- Simpan Pembayaran Controller
    public function simpanPembayaran()
    {
        if ($this->request->isAJAX()) {
            $no_faktur       = $this->request->getVar('no_faktur');
            $total_kotor     = $this->request->getVar('total_kotor');
            $jam             = $this->request->getVar('jam');
            $tgl_transaksi   = $this->request->getVar('tgl_transaksi');
            $nama_kasir      = $this->request->getVar('nama_kasir');
            $diskon_persen   = \str_replace(",", "", $this->request->getVar('diskon_persen'));
            $diskon_uang     = \str_replace(",", "", $this->request->getVar('diskon_uang'));
            $jumlah_uang     = \str_replace(",", "", $this->request->getVar('jumlah_uang'));
            $total_bersih    = \str_replace(",", "", $this->request->getVar('total_bersih'));
            $sisa_uang       = \str_replace(",", "", $this->request->getVar('sisa_uang'));

            // insert ke table transaksi

            $insertDataTransaksi = [
                'no_faktur'     => $no_faktur,
                'tgl_transaksi' => $tgl_transaksi,
                'jam'           => $jam,
                'nama_kasir'    => $nama_kasir,
                'diskon_persen' => $diskon_persen,
                'diskon_uang'   => $diskon_uang,
                'total_kotor'   => $total_kotor,
                'total_bersih'  => $total_bersih,
                'jumlah_uang'   => $jumlah_uang,
                'sisa_uang'     => $sisa_uang
            ];
            $this->transaksiModel->insert($insertDataTransaksi);
            // insert table transaksi end

            // insert ke table detail transaksi
            $fieldDetailTransaksi = [];
            $ambilDataTemp = $this->tempModel->where(['no_faktur' => $no_faktur])->get()->getResultArray();

            foreach ($ambilDataTemp as $row) {
                $fieldDetailTransaksi[] = [
                    'no_faktur'   => $row['no_faktur'],
                    'id_obat'     => $row['id_obat'],
                    'harga_pokok' => $row['harga_pokok'],
                    'harga_jual'  => $row['harga_jual'],
                    'qty'         => $row['qty'],
                    'sub_total'   => $row['sub_total'],
                ];
            }
            $this->detailtransaksiModel->insertBatch($fieldDetailTransaksi);

            $this->tempModel->where('no_faktur', $no_faktur)->delete();

            $msg = [
                'success' => 'berhasil',
                'no_faktur' => $no_faktur
            ];
            return $this->response->setJSON($msg);
        }
    }

    public function autofill()
    {
        if ($this->request->isAJAX()) {
            $barcode_obat = $this->request->getVar('barcode_obat');
            $nama_obat    = $this->request->getVar('nama_obat');
            $kode_rak     = $this->request->getVar('kode_rak');

            // Query untuk mencari obat
            $queryCekObat = $this->obatModel
                ->select('tbl_obat.*, tbl_golongan.nama_golongan, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan')
                ->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan', 'left')
                ->like('nama_obat', $barcode_obat)
                ->orLike('barcode_obat', $barcode_obat)
                ->orLike('kode_rak', $barcode_obat)
                ->get();

            // Menghitung total data hasil pencarian
            $totalData = $queryCekObat->getNumRows();

            if ($totalData > 0) {
                $result = [];
                // Loop melalui hasil query
                foreach ($queryCekObat->getResultArray() as $obat) {
                    $result[] = [
                        'value' => $obat['barcode_obat'],
                        'id'    => $obat['id'],
                        'harga_jual' => "Rp " . \number_format($obat['harga_jual'], 0, ",", "."),
                        'kode_rak'  => $obat['kode_rak'],
                        'stok_obat'  => \number_format($obat['stok_obat']),
                        'nama_satuan'  => $obat['nama_satuan'],
                        'nama_obat'  => $obat['nama_obat'],
                    ];
                }

                $msg = [
                    'success' => 'berhasil',
                    'data'    => $result
                ];
            } elseif ($totalData == 0) {
                // Jika tidak ada data, tampilkan pesan obat tidak terdaftar
                $result[] = [
                    'harga_jual' => ' ',
                    'kode_rak'  => ' ',
                    'stok_obat'  => ' ',
                    'nama_satuan'  => ' ',
                    'nama_obat'  => 'Obat tidak Terdaftar',
                ];
                $msg = [
                    'success' => 'berhasil',
                    'data'    => $result
                ];
            }

            return $this->response->setJSON($msg);
        }
    }

    public function cetakStruk()
    {
        function buatBaris1Kolom($kolom1)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 33;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = count($kolom1Array);

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }

        function buatBaris3Kolom($kolom1, $kolom2, $kolom3)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 11;
            $lebar_kolom_2 = 11;
            $lebar_kolom_3 = 11;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_LEFT);

                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }



        $profile = CapabilityProfile::load("simple");
        $connector = new WindowsPrintConnector("apotek_printer");
        $printer = new Printer($connector, $profile);

        $no_faktur = $this->request->getVar('no_faktur');

        $queryTransaksi = $this->transaksiModel->getWhere(['no_faktur' => $no_faktur]);
        $rowTransaksi   = $queryTransaksi->getRowArray();

        // judul
        $printer->initialize();
        $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Apotek Sumber Sekar" . "\n");
        $printer->text("Jl. Raya Sumbersekar No.2," . "\n");
        $printer->text("RT.05/RW.02, Krajan," . "\n");
        $printer->text("Sumbersekar, Kec. Dau, " . "\n");
        $printer->text("Kabupaten Malang" . "\n");
        $printer->text("Jawa Timur 65151" . "\n");
        $printer->text("Phone: 085175126445" . "\n");
        $printer->text("\n");

        // header
        $printer->initialize();
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->text(buatBaris1Kolom("Faktur : $no_faktur"));
        $printer->text(buatBaris1Kolom("Tanggal : " . ($rowTransaksi['tgl_transaksi']) . " " . ($rowTransaksi['jam'])));


        $printer->text(buatBaris1Kolom("---------------------------------"));

        $queryTransaksiDetail = $this->detailtransaksiModel->select('nama_obat, qty, nama_satuan, harga_jual, sub_total')
            ->join('tbl_obat', 'tbl_obat.id = tbl_detail_transaksi.id_obat')
            ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan')
            ->where('no_faktur', $no_faktur)
            ->get();


        $total_pembayaran = 0;
        foreach ($queryTransaksiDetail->getResultArray() as $d) {
            $printer->text(buatBaris1Kolom("$d[nama_obat]"));
            $printer->text(buatBaris3Kolom(\number_format($d['qty'], 0) . ' ' . $d['nama_satuan'], \number_format($d['harga_jual'], 0), \number_format($d['sub_total'])));

            $total_pembayaran += $d['sub_total'];
        }

        $printer->text(buatBaris1Kolom("---------------------------------"));
        $printer->text(buatBaris3Kolom("", "Subtotal : ", 'Rp' . \number_format($rowTransaksi['total_kotor'], 0)));
        $printer->text(buatBaris3Kolom("", "Disc(%) : ", \number_format($rowTransaksi['diskon_persen'], 0) . '%'));
        $printer->text(buatBaris3Kolom("", "Disc(Rp) : ", 'Rp' . \number_format($rowTransaksi['diskon_uang'], 0)));
        $printer->text(buatBaris3Kolom("", "Total : ", 'Rp' . \number_format($rowTransaksi['total_bersih'], 0)));
        $printer->text(buatBaris3Kolom("", "Tunai : ", 'Rp' . \number_format($rowTransaksi['jumlah_uang'], 0)));
        $printer->text(buatBaris3Kolom("", "Kembali : ", 'Rp' . \number_format($rowTransaksi['sisa_uang'], 0)));
        $printer->text("\n");

        $printer->initialize();
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Terimakasih Atas Kunjungannya");
        $printer->text("Barang yang sudah dibeli");
        $printer->text("tidak dapat kembali");


        $printer->feed(4);
        $printer->cut();
        echo "Struk berhasil dicetak";
        $printer->close();
    }
}
