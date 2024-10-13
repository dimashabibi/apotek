<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'tbl_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = ['nama_kategori', 'ket_kategori'];

    public function getKategori()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_kategori');
        $builder->select('tbl_kategori.*');
        $query = $builder->get();

        return $query->getResultArray();
    }

    // public function getObatByKategori($kategoriId)
    // {
    //     $db      = \Config\Database::connect();
    //     $builder = $db->table('tbl_kategoriobat');
    //     $builder->select('tbl_obat.*, tbl_kategori.nama_kategori');
    //     $builder->join('tbl_obat', 'tbl_obat.id = tbl_kategoriobat.id_obat', 'left');
    //     $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_kategoriobat.id_kategori', 'left');

    //     // Filter obat berdasarkan kategori yang dipilih
    //     $builder->where('tbl_kategoriobat.id_kategori', $kategoriId);

    //     $builder->orderBy('tbl_obat.nama_obat', 'ASC');  // Misal urutkan berdasarkan nama obat
    //     $query = $builder->get();

    //     return $query->getResultArray();
    // }

    // public function getKategoriById($kategoriId)
    // {
    //     $db      = \Config\Database::connect();
    //     $builder = $db->table('tbl_kategori');
    //     $builder->select('nama_kategori');
    //     $builder->where('id', $kategoriId);
    //     $query = $builder->get();

    //     return $query->getResultArray();  // Mengembalikan satu baris data kategori
    // }

    public function getNestedObat($kategori_id = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_obat');
        $builder->select('tbl_obat.*, tbl_kategori.nama_kategori, tbl_golongan.nama_golongan, tbl_supplier.nama_supplier, tbl_pabrik.nama_pabrik, tbl_satuan.nama_satuan, tbl_etiket.nama_etiket');
        $builder->join('tbl_golongan', 'tbl_golongan.id = tbl_obat.id_golongan');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori');
        $builder->join('tbl_supplier', 'tbl_supplier.id = tbl_obat.id_supplier');
        $builder->join('tbl_pabrik', 'tbl_pabrik.id = tbl_obat.id_pabrik');
        $builder->join('tbl_satuan', 'tbl_satuan.id = tbl_obat.id_satuan');
        $builder->join('tbl_etiket', 'tbl_etiket.id = tbl_obat.id_etiket');

        if ($kategori_id !== null) {
            $builder->where('tbl_obat.id_kategori', $kategori_id);
        }

        $builder->orderBy('tbl_obat.nama_obat', 'asc');
        $query = $builder->get();

        return $query->getResultArray();
    }
}
