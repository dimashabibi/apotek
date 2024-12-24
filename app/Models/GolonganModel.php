<?php

namespace App\Models;

use CodeIgniter\Model;

class GolonganModel extends Model
{
    protected $table            = 'tbl_golongan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_golongan',
        'ket_golongan',
        'created_at',
        'deleted_at'
    ];
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

}
