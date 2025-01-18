<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObatModel;
use App\Models\KategoriModel;
use App\Models\GolonganModel;;

use App\Models\SatuanModel;
use App\Models\EtiketModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PHPExcel;
use PHPExcel_IOFactory;

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
        $validation = \Config\Services::validation();

        $validation->setRules([
            'kode_rak' => [
                'label'  => 'Kode Rak',
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required' => 'Kode rak belum diinput',
                    'max_length' => 'Maksimal 25 karakter',
                ],
            ],
            'merk_obat' => [
                'label'  => 'Merk Obat',
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Merk belum diinput.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'nama_obat' => [
                'label'  => 'Nama Obat',
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama obat belum diinput.',
                    'max_length' => 'Maksimal 100 karakter.',
                ],
            ],
            'id_golongan' => [
                'label'  => 'Golongan',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Golongan belum diinput.',
                ],
            ],
            'id_kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori belum diinput.',
                ],
            ],
            'konsinyasi' => [
                'label'  => 'Konsinyasi',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Konsinyasi belum diinput.',
                ],
            ],
            'stok_min' => [
                'label'  => 'Stok minimal',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok minimal belum diinput.',
                ],
            ],
            'stok_obat' => [
                'label'  => 'Stok obat',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok obat belum diinput.',
                ],
            ],
            'id_satuan' => [
                'label'  => 'Satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Satuan belum diinput.',
                ],
            ],
            'id_etiket' => [
                'label'  => 'Etiket',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Etiket belum diinput.',
                ],
            ],
            'harga_pokok' => [
                'label'  => 'Harga pokok',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga pokok belum diinput.',
                ],
            ],
            'harga_jual' => [
                'label'  => 'Harga jual',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga jual belum diinput.',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
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

        $validation = \Config\Services::validation();

        $validation->setRules([
            'kode_rak' => [
                'label'  => 'Kode Rak',
                'rules'  => 'required|max_length[25]',
                'errors' => [
                    'required' => 'Kode rak belum diinput',
                    'max_length' => 'Maksimal 25 karakter',
                ],
            ],
            'merk_obat' => [
                'label'  => 'Merk Obat',
                'rules'  => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Merk belum diinput.',
                    'max_length' => 'Maksimal 50 karakter.',
                ],
            ],
            'nama_obat' => [
                'label'  => 'Nama Obat',
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama obat belum diinput.',
                    'max_length' => 'Maksimal 100 karakter.',
                ],
            ],
            'id_golongan' => [
                'label'  => 'Golongan',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Golongan belum diinput.',
                ],
            ],
            'id_kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kategori belum diinput.',
                ],
            ],
            'konsinyasi' => [
                'label'  => 'Konsinyasi',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Konsinyasi belum diinput.',
                ],
            ],
            'stok_min' => [
                'label'  => 'Stok minimal',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok minimal belum diinput.',
                ],
            ],
            'stok_obat' => [
                'label'  => 'Stok obat',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Stok obat belum diinput.',
                ],
            ],
            'id_satuan' => [
                'label'  => 'Satuan',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Satuan belum diinput.',
                ],
            ],
            'id_etiket' => [
                'label'  => 'Etiket',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Etiket belum diinput.',
                ],
            ],
            'harga_pokok' => [
                'label'  => 'Harga pokok',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga pokok belum diinput.',
                ],
            ],
            'harga_jual' => [
                'label'  => 'Harga jual',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga jual belum diinput.',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        } else {
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

    //-------------------------- Delete Obat ----------------------------------------
    public function delete_obat($id)
    {
        $this->obatModel->delete($id);
        session()->setFlashdata('success', 'Obat berhasil dihapus');
        return redirect()->to(base_url('/daftar_obat'));
    }

    public function exportExcel()
    {
        $obat = $this->obatModel->getObat();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Kode Rak');
        $sheet->setCellValue('B1', 'Barcode Obat');
        $sheet->setCellValue('C1', 'Kandungan Obat');
        $sheet->setCellValue('D1', 'Nama Obat');
        $sheet->setCellValue('E1', 'Golongan Obat');
        $sheet->setCellValue('F1', 'Kategori');
        $sheet->setCellValue('G1', 'Konsinyasi');
        $sheet->setCellValue('H1', 'Stok Minimum');
        $sheet->setCellValue('I1', 'Stok Tersedia');
        $sheet->setCellValue('J1', 'Satuan');
        $sheet->setCellValue('K1', 'Harga Pokok');
        $sheet->setCellValue('L1', 'Harga Jual');
        $sheet->setCellValue('M1', 'Etiket');

        // Style the header row
        $sheet->getStyle('A1:M1')->getFont()->setBold(true);
        $sheet->getStyle('A1:M1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('CCCCCC');

        // Add data
        $row = 2;
        foreach ($obat as  $item) {
            $sheet->setCellValue('A' . $row, $item['kode_rak']);
            $sheet->setCellValue('B' . $row, $item['barcode_obat']);
            $sheet->setCellValue('C' . $row, $item['merk_obat']);
            $sheet->setCellValue('D' . $row, $item['nama_obat']);
            $sheet->setCellValue('E' . $row, $item['nama_golongan']);
            $sheet->setCellValue('F' . $row, $item['nama_kategori']);
            $sheet->setCellValue('G' . $row, $item['konsinyasi']);
            $sheet->setCellValue('H' . $row, $item['stok_min']);
            $sheet->setCellValue('I' . $row, $item['stok_obat']);
            $sheet->setCellValue('J' . $row, $item['nama_satuan']);
            $sheet->setCellValue('K' . $row, $item['harga_pokok']);
            $sheet->setCellValue('L' . $row, $item['harga_jual']);
            $sheet->setCellValue('M' . $row, $item['nama_etiket']);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'M') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Format currency columns with custom Indonesian Rupiah format
        $sheet->getStyle('K2:M' . ($row - 1))->getNumberFormat()
            ->setFormatCode('_("Rp"* #,##0_);_("Rp"* -#,##0_);_("Rp"* "-"??_);_(@_)');

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Daftar_Obat_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

    public function importExcel()
    {
        $data = [
            'title'             => 'Import Obat | Apotek Sumbersekar',
            'menu'              => 'master_data',
            'submenu'           => 'obat',
        ];
        return view('obat/import_view', $data);
    }

    public function processImport()
    {
        $validation = \Config\Services::validation();
        $validationRule = [
            'fileexcel' => [
                'rules' => 'uploaded[fileexcel]|ext_in[fileexcel,xlsx,xls]',
                'errors' => [
                    'uploaded' => 'Pilih file excel terlebih dahulu.',
                    'ext_in' => 'Format file harus Excel (.xlsx atau .xls)'
                ]
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('fileexcel');
        if ($file) {
            $excelReader = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            // Mengambil lokasi temp file
            $fileLocation = $file->getTempName();
            // Baca file
            $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileLocation);
            // Ambil sheet active
            $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $successful = 0;
            $failed = 0;
            $errors = [];

            // Start from index 1 to skip header row
            foreach (array_slice($sheet, 1) as $row => $data) {
                // Skip empty rows
                if (empty(array_filter($data))) {
                    continue;
                }

                try {
                    // Required field validation
                    if (empty($data['D'])) {
                        throw new \Exception("nama obat wajib diisi");
                    }

                    // Get related data IDs
                    $golongan = $this->getGolonganId(trim($data['F']));
                    $kategori = $this->getKategoriId(trim($data['F']));
                    $satuan = $this->getSatuanId(trim($data['J']));
                    $etiket = $this->getEtiketId(trim($data['M']));

                    $obatData = [
                        'kode_rak'     => trim($data['A']),
                        'barcode_obat' => trim($data['B']),
                        'merk_obat'    => trim($data['C']),
                        'nama_obat'    => trim($data['D']),
                        'id_golongan'  => $golongan,
                        'id_kategori'  => $kategori,
                        'konsinyasi'   => trim($data['G']),
                        'stok_min'     => (int)$data['H'],
                        'stok_obat'    => (int)$data['I'],
                        'id_satuan'    => $satuan,
                        'harga_pokok'  => (float)str_replace(['Rp', '.', ','], '', $data['K']),
                        'harga_jual'   => (float)str_replace(['Rp', '.', ','], '', $data['L']),
                        'id_etiket'    => $etiket
                    ];

                    // Check if data exists (based on barcode)
                    $existingObat = $this->obatModel->where('nama_obat', $data['D'])->first();

                    if ($existingObat) {
                        $this->obatModel->update($existingObat['id'], $obatData);
                    } else {
                        $this->obatModel->insert($obatData);
                    }

                    $successful++;
                } catch (\Exception $e) {
                    $failed++;
                    $errors[] = "Baris " . ($row + 2) . ": " . $e->getMessage();
                }
            }

            $message = "Import selesai: $successful data berhasil diimport, $failed data gagal.";
            if (!empty($errors)) {
                $message .= "\nDetail error:\n" . implode("\n", $errors);
            }

            return redirect()->to(site_url('daftar_obat'))->with('success', $message);
        }
    }

    // Helper methods untuk mendapatkan ID dari nama
    private function getGolonganId($nama)
    {
        if (empty($nama)) throw new \Exception("Golongan obat harus diisi");

        $golongan = $this->golonganModel
            ->where('nama_golongan', $nama)
            ->get()
            ->getRowArray();


        if (!$golongan) {
            // Auto create new golongan
            date_default_timezone_set('Asia/Jakarta');
            $data = [
                'nama_golongan' => $nama,
                'ket_golongan' => '-',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->golonganModel->insert($data);
            return $this->golonganModel->insertID();
        }

        return $golongan['id'];
    }

    private function getKategoriId($nama)
    {
        if (empty($nama)) throw new \Exception("Kategori harus diisi");

        $kategori = $this->kategoriModel
            ->where('nama_kategori', $nama)
            ->get()
            ->getRowArray();

        if (!$kategori) {
            date_default_timezone_set('Asia/Jakarta');
            // Auto create new kategori
            $data = [

                'nama_kategori' => $nama,
                'ket_kategori' => '-',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->kategoriModel->insert($data);
            return $this->kategoriModel->insertID();
        }

        return $kategori['id'];
    }

    private function getSatuanId($nama)
    {
        if (empty($nama)) throw new \Exception("Satuan harus diisi");

        $satuan = $this->satuanModel
            ->where('nama_satuan', $nama)
            ->get()
            ->getRowArray();

        if (!$satuan) {
            date_default_timezone_set('Asia/Jakarta');
            // Auto create new satuan
            $data = [
                'nama_satuan' => $nama,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->satuanModel->insert($data);
            return $this->satuanModel->insertID();
        }

        return $satuan['id'];
    }

    private function getEtiketId($nama)
    {
        if (empty($nama)) throw new \Exception("Etiket harus diisi");

        $etiket = $this->etiketModel
            ->where('nama_etiket', $nama)
            ->get()
            ->getRowArray();

        if (!$etiket) {
            date_default_timezone_set('Asia/Jakarta');
            // Auto create new etiket
            $data = [

                'nama_etiket' => $nama,
                'ket_etiket' => '-',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->etiketModel->insert($data);
            return $this->satuanModel->insertID();
        }

        return $etiket['id'];
    }

    public function templateExcel()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Kode Rak');
        $sheet->setCellValue('B1', 'Barcode Obat');
        $sheet->setCellValue('C1', 'Kandungan Obat');
        $sheet->setCellValue('D1', 'Nama Obat');
        $sheet->setCellValue('E1', 'Golongan Obat');
        $sheet->setCellValue('F1', 'Kategori');
        $sheet->setCellValue('G1', 'Konsinyasi');
        $sheet->setCellValue('H1', 'Stok Minimum');
        $sheet->setCellValue('I1', 'Stok Tersedia');
        $sheet->setCellValue('J1', 'Satuan');
        $sheet->setCellValue('K1', 'Harga Pokok');
        $sheet->setCellValue('L1', 'Harga Jual');
        $sheet->setCellValue('M1', 'Etiket');

        // Style the header row
        $sheet->getStyle('A1:M1')->getFont()->setBold(true);
        $sheet->getStyle('A1:M1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('CCCCCC');

        // Auto-size columns
        foreach (range('A', 'M') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template_import_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
