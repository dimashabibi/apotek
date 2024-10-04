<?php

namespace App\Controllers;


class PagesController extends BaseController
{
    public function home()
    {
        $data = [
            'title' => 'Dashboard',
            'content_header' => 'Dashboard',
            'breadcrumb' => 'Home',
            'breadcrumb_active' => 'Dashboard'
        ];
        return view('pages/home', $data);
    }

    public function kasir()
    {
        $data = [
            'title' => 'Kasir',
            'content_header' => 'Kasir',
            'breadcrumb' => 'Home',
            'breadcrumb_active' => 'Kasir'
        ];
        return view('pages/kasir', $data);
    }
}
