<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'tbl_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['nama_kategori'];

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
        $builder->select('tbl_obat.*, tbl_kategori.id AS id_kategori, tbl_kategori.nama_kategori');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_obat.id_kategori', 'left');

        if ($kategori_id !== null) {
            $builder->where('tbl_obat.id_kategori', $kategori_id);
        }

        $builder->orderBy('tbl_obat.nama_obat', 'asc');
        $query = $builder->get();

        return $query->getResultArray();
    }
}
