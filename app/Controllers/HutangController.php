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
            'total_hutang'     => \str_replace(",", "", $this->request->getVar('total_hutang'))
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
}
