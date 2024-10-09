<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriobatModel extends Model
{
    protected $table            = 'tbl_kategoriobat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = ['id_kategori', 'id_obat'];
}
