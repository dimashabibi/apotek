<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DataObatModel extends Model
{
    protected $table = 'tbl_obat';
    protected $column_order = [null, 'kode_rak', 'barcode_obat', 'nama_obat', 'nama_golongan', 'nama_kategori', 'nama_satuan', 'stok_obat', 'harga_jual', null];
    protected $column_search = ['kode_rak', 'barcode_obat', 'nama_obat'];
    protected $order = ['nama_obat' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
    }

    private function getDatatablesQuery($keywordbarcode)
    {
        if (\strlen($keywordbarcode) == 0) {
            $this->dt = $this->db->table($this->table)
                ->select('tbl_obat.*, tbl_golongan.nama_golongan, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan')
                ->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan', 'left');
        } else {
            $this->dt = $this->db->table($this->table)
                ->select('tbl_obat.*, tbl_golongan.nama_golongan, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan')
                ->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan', 'left')
                ->like('barcode_obat', $keywordbarcode)
                ->orLike('nama_obat', $keywordbarcode)
                ->orLike('kode_rak', $keywordbarcode);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables($keywordbarcode)
    {
        $this->getDatatablesQuery($keywordbarcode);
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered($keywordbarcode)
    {
        $this->getDatatablesQuery($keywordbarcode);
        return $this->dt->countAllResults();
    }

    public function countAll($keywordbarcode)
    {
        if (\strlen($keywordbarcode) == 0) {
            $tbl_storage = $this->db->table($this->table)
                ->select('tbl_obat.*, tbl_golongan.nama_golongan, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan')
                ->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan', 'left');
        } else {
            $tbl_storage = $this->db->table($this->table)
                ->select('tbl_obat.*, tbl_golongan.nama_golongan, tbl_kategori.nama_kategori, tbl_satuan.nama_satuan')
                ->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan', 'left')
                ->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left')
                ->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan', 'left')
                ->like('barcode_obat', $keywordbarcode)
                ->orLike('nama_obat', $keywordbarcode)
                ->orLike('kode_rak', $keywordbarcode);
        }

        return $tbl_storage->countAllResults();
    }
}
