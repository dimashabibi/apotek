<?php

namespace App\Controllers;


class PagesController extends BaseController
{
    public function home()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('pages/home', $data);
    }
}
