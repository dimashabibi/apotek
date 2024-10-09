<?php

namespace App\Controllers;

use App\Models\UserModel;

use function PHPUnit\Framework\returnSelf;

class AuthController extends BaseController
{

    //------------------------------- Login Controller -----------------------------------------
    public function index()
    {

        $data = [
            'title' => 'Login Page',
        ];
        return view('auth/login_page', $data);
    }

    public function proses_login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $usermodel = new UserModel();
        $datauser = $usermodel->where('username', $username)->first();
        if ($datauser) {
            if (password_verify($password, $datauser['password'])) {
                session()->set([
                    'user_id'   => $datauser['id'],
                    'nama_user' => $datauser['nama_user'],
                    'username'  => $datauser['username'],
                    'password'  => $datauser['password'],
                    'logged_in' => true,
                ]);
                session()->setFlashdata('success', 'Login Berhasil');
                return redirect()->to(base_url('/home'));
            } else {
                session()->setFlashdata('error', 'Login Gagal');
                return redirect()->back();
            }
        }
    }

    //------------------------------- Register Controller -----------------------------------------
    public function register()
    {
        $data = [
            'title' => 'Register Page'
        ];
        return view('auth/register_page', $data);
    }

    public function proses_register()
    {
        $usermodel = new UserModel();
        $usermodel->insert([
            'nama_user' => $this->request->getVar('nama_user'),
            'username'  => $this->request->getVar('username'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);
        session()->getFlashdata('success', 'Register Berhasil');
        return redirect()->to(base_url('/login'));
    }

    //------------------------------- Logout Controller -----------------------------------------
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
