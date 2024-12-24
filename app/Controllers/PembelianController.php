<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\TempPembelianModel;
use App\Models\DetailPembelianModel;
use App\Models\ObatModel;
use App\Models\KategoriModel;
use App\Models\GolonganModel;
use App\Models\SupplierModel;
use App\Models\PabrikModel;
use App\Models\SatuanModel;
use App\Models\EtiketModel;
use CodeIgniter\HTTP\ResponseInterface;

class PembelianController extends BaseController
{
    protected $pembelianModel;
    protected $temppembelianModel;
    protected $detailpembelianModel;
    protected $obatModel;
    protected $kategoriModel;
    protected $golonganModel;
    protected $supplierModel;
    protected $pabrikModel;
    protected $satuanModel;
    protected $etiketModel;

    public function __construct()
    {
        $this->pembelianModel         = new PembelianModel();
        $this->temppembelianModel     = new TempPembelianModel();
        $this->detailpembelianModel     = new DetailPembelianModel();
        $this->obatModel              = new ObatModel();
        $this->kategoriModel          = new KategoriModel();
        $this->golonganModel          = new GolonganModel();
        $this->supplierModel          = new SupplierModel();
        $this->pabrikModel            = new PabrikModel();
        $this->etiketModel            = new EtiketModel();
        $this->satuanModel            = new SatuanModel();
    }

    public function pembelian()
    {
        $id_pembelian = $this->pembelianModel->getNoPembelian();
        $data = [
            'title'             => 'Pembelian Obat | Apotek Sumbersekar',
            'menu'              => 'pembelian',
            'submenu'           => '',
            'id_pembelian'      => $id_pembelian,
            'supplier'          => $this->supplierModel->findAll()
        ];

        return \view('pembelian/pembelian', $data);
    }

    public function autofillPembelian()
    {
        if ($this->request->isAJAX()) {
            $barcode_obat  = $this->request->getVar('barcode_obat');
            $nama_obat     = $this->request->getVar('nama_obat');
            $kode_rak     = $this->request->getVar('kode_rak');

            $queryCekObat = $this->obatModel
                ->select('tbl_obat.*, tbl_golongan.nama_golongan, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan')
                ->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan', 'left')
                ->like('nama_obat', $barcode_obat)
                ->orlike('barcode_obat', $barcode_obat)
                ->orlike('kode_rak', $barcode_obat)
                ->get();


            $totalData    = $queryCekObat->getNumRows();

            if ($totalData > 0) {
                $result = [];
                // Loop melalui hasil query
                foreach ($queryCekObat->getResultArray() as $obat) {
                    $result[] = [
                        'value' => $obat['barcode_obat'],
                        'id'    => $obat['id'],
                        'harga_pokok' => "Rp " . \number_format($obat['harga_pokok'], 0, ",", "."),
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
                    'harga_pokok' => ' ',
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

    // ------------------------------------------------------------------------- Data Detail Controller
    public function dataDetailPembelian()
    {
        if ($this->request->isAJAX()) {
            $id_pembelian = $this->request->getVar('id_pembelian');
            $detail = $this->temppembelianModel->getTempPembelian($id_pembelian);

            $data = [
                'datadetail' => $detail
            ];
            $msg = [
                'data' => view('item/view_detail_pembelian', $data)
            ];

            return $this->response->setJSON($msg);
        }
    }
    // Data Detail End

    public function simpanTempPembelian()
    {
        if ($this->request->isAJAX()) {
            $id_pembelian     = $this->request->getVar('id_pembelian');
            $barcode_obat     = $this->request->getVar('barcode_obat');
            $nama_obat     = $this->request->getVar('nama_obat');
            $qty              = $this->request->getVar('qty');
            $harga_pokok      = $this->request->getVar('harga_pokok');


            $queryCekObat = $this->obatModel
                ->where('nama_obat', $nama_obat)
                ->orwhere('barcode_obat', $nama_obat)
                ->orwhere('kode_rak', $nama_obat)
                ->get();

            $totalData = $queryCekObat->getNumRows();

            if ($totalData == 1) {
                $rowObat = $queryCekObat->getRowArray();

                $tempObat = $this->temppembelianModel
                    ->where('id_pembelian', $id_pembelian)
                    ->where('id_obat', $rowObat['id'])
                    ->first();

                if ($tempObat) {
                    // Jika obat sudah ada, tambahkan qty
                    $newQty = $tempObat['qty'] + $qty;
                    $updateData = [
                        'id_pembelian'   => $id_pembelian,
                        'id_obat'        => $rowObat['id'],
                        'harga_pokok'    => $rowObat['harga_pokok'],
                        'qty'            => $newQty,
                        'sub_total'      => intval($rowObat['harga_pokok'] * $newQty)
                    ];
                    $this->temppembelianModel->update($tempObat['detail_pembelian_id'], $updateData);
                } else {
                    // Jika obat belum ada, insert data baru
                    $insertData = [
                        'id_pembelian'   => $id_pembelian,
                        'id_obat'        => $rowObat['id'],
                        'harga_pokok'    => $rowObat['harga_pokok'],
                        'qty'            => $qty,
                        'sub_total'      => intval($rowObat['harga_pokok'] * $qty)
                    ];
                    $this->temppembelianModel->insert($insertData);
                }
                $msg = ['success' => 'berhasil'];
            } else {
                $msg = [
                    'error' => 'Maaf obat tidak terdaftar'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }

    public function hitungTotalBeli()
    {
        if ($this->request->isAJAX()) {
            $id_pembelian = $this->request->getVar('id_pembelian');

            $queryTotal = $this->temppembelianModel->select('SUM(sub_total) as total_pembelian')->where('id_pembelian', $id_pembelian)->get();

            $rowTotal = $queryTotal->getRowArray();

            $msg = [
                'totalbeli' => "Rp" . " " . " " . number_format($rowTotal['total_pembelian'], 0, ",", ".")
            ];
            return $this->response->setJSON($msg);
        }
    }

    public function hapusItemBeli()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $hapusitem = $this->temppembelianModel->where('detail_pembelian_id', $id)->delete();

            if ($hapusitem) {
                $msg = [
                    'success' => 'berhasil'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }

    public function editItemBeli()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('nama_obat');
            $cekObat = $this->obatModel->find($id);
            if (!$cekObat) {
                return $this->response->setJSON([
                    'error' => 'Data obat dengan ID ini tidak ditemukan.'
                ])->setStatusCode(404);
            }

            $obat     = $cekObat;
            $golongan = isset($obat['id_golongan']) ? $this->golonganModel->find($obat['id_golongan']) : null;
            $kategori = isset($obat['id_kategori']) ? $this->kategoriModel->find($obat['id_kategori']) : null;
            $satuan = isset($obat['id_satuan']) ? $this->satuanModel->find($obat['id_satuan']) : null;
            $etiket = isset($obat['id_etiket']) ? $this->etiketModel->find($obat['id_etiket']) : null;

            $data = [
                'obat'                => $obat,
                'kategoriId'          => $kategori,
                'golonganId'          => $golongan,
                'satuanId'            => $satuan,
                'etiketId'            => $etiket,
            ];

            $msg = [
                'editItem' => view('item/modal_edit', $data)
            ];
            $msg = [
                'error' => 'ID tidak ditemukan'
            ];
            return $this->response->setJSON($msg);
        }
    }

    public function batalPembelian()
    {
        if ($this->request->isAJAX()) {
            $hapusTable = $this->temppembelianModel->emptyTable();
            if ($hapusTable) {
                $msg = [
                    'success' => 'berhasil'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }


    public function simpanPembelian()
    {
        if ($this->request->isAJAX()) {
            $id_pembelian      = $this->request->getVar('id_pembelian');
            $tgl_pembelian     = $this->request->getVar('tgl_pembelian');
            $id_supplier       = $this->request->getVar('id_supplier');
            $no_faktur         = $this->request->getVar('no_faktur');
            $deskripsi         = $this->request->getVar('deskripsi');

            $cekTemp = $this->temppembelianModel->where(['id_pembelian' => $id_pembelian])->get();

            $queryTotal  = $this->temppembelianModel->select('SUM(sub_total) as total_beli')->where('id_pembelian', $id_pembelian)->get();

            $rowTotal    = $queryTotal->getRowArray();


            if ($cekTemp->getNumRows() > 0) {
                // insert ke table transaksi
                $insertDataPembelian = [
                    'id_pembelian'     => $id_pembelian,
                    'tgl_pembelian'    => $tgl_pembelian,
                    'id_supplier'      => $id_supplier,
                    'no_faktur'        => $no_faktur,
                    'total_pembelian'  => $rowTotal['total_beli'],
                    'deskripsi'        => $deskripsi,
                ];
                $this->pembelianModel->insert($insertDataPembelian);
                // insert table transaksi end

                // insert ke table detail transaksi
                $fieldDetailPembelian = [];
                $ambilDataTemp = $this->temppembelianModel->where(['id_pembelian' => $id_pembelian])->get()->getResultArray();

                foreach ($ambilDataTemp as $row) {
                    $fieldDetailPembelian[] = [
                        'id_pembelian'   => $row['id_pembelian'],
                        'id_obat'        => $row['id_obat'],
                        'harga_pokok'    => $row['harga_pokok'],
                        'qty'            => $row['qty'],
                        'sub_total'      => $row['sub_total'],
                    ];
                }
                $this->detailpembelianModel->insertBatch($fieldDetailPembelian);

                $this->temppembelianModel->where('id_pembelian', $id_pembelian)->delete();

                $msg = [
                    'success' => 'berhasil'
                ];
            } else {
                $msg = [
                    'error' => 'Data belum diinput..'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }
}
