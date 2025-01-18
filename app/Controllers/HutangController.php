<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HutangModel;

class HutangController extends BaseController
{
    protected $hutangModel;

    public function __construct()
    {
        $this->hutangModel = new HutangModel();
    }

    public function hutang()
    {
        $data = [
            'menu'                    => 'hutang',
            'submenu'                 => '',
            'title'                   => 'Halaman Hutang',
            'hutang'                  => $this->hutangModel->findAll(),
            'no_hutang'               => $this->hutangModel->getNoHutang(),
            'grand_total_hutang' => $this->hutangModel
                ->select('SUM(total_hutang) as total_hutang')
                ->where('is_paid', 0)
                ->first()['total_hutang'] ?? 0,
        ];
        return view('hutang/hutang', $data);
    }

    public function tambah_hutang()
    {

        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_hutang' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID Tidak boleh sama.',
                ],
            ],
            'tanggal' => [
                'label'  => 'Tanggal',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal belum diinput.',
                ],
            ],
            'nama_distributor' => [
                'label'  => 'Nama Distributor',
                'rules'  => 'required|max_length[254]',
                'errors' => [
                    'required' => 'Distributor belum diinput.',
                    'max_length' => 'Nama distributor maksimal 254 karakter.',
                ],
            ],
            'total_hutang' => [
                'label'  => 'Nominal Hutang',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Total hutang belum diinput.',
                ],
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $this->hutangModel->insert([
            'id_hutang'        => $this->request->getVar('id_hutang'),
            'tanggal'          => $this->request->getVar('tanggal'),
            'paid_at'          => $this->request->getVar('paid_at'),
            'nama_distributor' => $this->request->getVar('nama_distributor'),
            'total_hutang'     => \str_replace(",", "", $this->request->getVar('total_hutang')),
            'sisa_hutang'      => '0'
        ]);

        return redirect()->to('/hutang')->with('success', 'Hutang berhasil ditambahkan');
    }

    public function markAsPaid()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $lunas = $this->hutangModel->markAsPaid($id);
            if ($lunas) {
                $msg = [
                    'success' => 'berhasil'
                ];
            } else {
                $msg = ['success' => 'gagal', 'message' => 'Gagal menandai hutang sebagai lunas.'];
            }
            return $this->response->setJSON($msg);
        }
        return $this->response->setStatusCode(400, 'Invalid Request');
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $hapusitem = $this->hutangModel->where('id_hutang', $id)->delete();

            if ($hapusitem) {
                $msg = [
                    'success' => 'berhasil'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }

    public function editHutang($id)
    {
        if ($this->request->isAJAX()) {
            $id_hutang = $this->hutangModel->find($id);

            $data = [
                'hutang' => $id_hutang,
            ];

            $msg = [
                'data' => view('hutang/modal_edit_hutang', $data),
            ];
            return $this->response->setJSON($msg);
        }
    }

    public function updateHutang()
    {
        if ($this->request->isAJAX()) {
            try {
                // Get form data
                $id_hutang = $this->request->getVar('detail_transaksi_id');
                $jumlah_cicil = str_replace([',', '.'], '', $this->request->getVar('jumlah_cicil'));

                // Get current debt data
                $ambiltotalhutang = $this->hutangModel->select('total_hutang, sisa_hutang')
                    ->where('id_hutang', $id_hutang)
                    ->get()
                    ->getRowArray();

                if (!$ambiltotalhutang) {
                    throw new \Exception('Data hutang tidak ditemukan');
                }

                // Convert to integers
                $total_hutang = intval($ambiltotalhutang['total_hutang']);
                $sisa_hutang = intval($ambiltotalhutang['sisa_hutang']);
                $jumlah_cicil = intval($jumlah_cicil);

                // Determine current balance to check against
                $current_balance = ($sisa_hutang == 0) ? $total_hutang : $sisa_hutang;

                // Validate payment amount
                if ($jumlah_cicil <= 0) {
                    return $this->response->setJSON([
                        'error' => 'Jumlah cicilan harus lebih dari 0'
                    ]);
                }

                if ($jumlah_cicil > $current_balance) {
                    return $this->response->setJSON([
                        'error' => 'Jumlah cicilan melebihi ' . ($sisa_hutang == 0 ? 'total hutang' : 'sisa cicilan')
                    ]);
                }

                // Calculate new balance
                $hitungtotal = $current_balance - $jumlah_cicil;

                // Update the record
                \date_default_timezone_set('Asia/Jakarta');
                $this->hutangModel->update($id_hutang, [
                    'paid_at' => date('Y-m-d H:i:s'),
                    'sisa_hutang' => $hitungtotal,
                    'is_paid' => ($hitungtotal === 0) ? 1 : 0
                ]);

                return $this->response->setJSON([
                    'success' => ($sisa_hutang == 0 ? 'Hutang' : 'Cicilan') . ' berhasil di bayar'
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
