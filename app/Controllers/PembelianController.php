<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PembelianController extends BaseController
{
    public function pembelian()
    {
        $data = [
            'title'             => 'Pembelian Obat | Apotek Sumbersekar',
            'menu'              => 'pembelian',
            'submenu'           => ''
        ];

        return \view('pembelian/pembelian',$data);
    }
}
