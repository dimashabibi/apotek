<?php

namespace App\Controllers;

use App\Models\UserModel;

use function PHPUnit\Framework\returnSelf;

class AuthController extends BaseController
{

    //------------------------------- Login Controller -----------------------------------------
    public function index()
    {

        if (session()->get('logged_in')) {
            return redirect()->to(base_url('/home'));
        }

        $data = [
            'title' => 'Login Page | Apotek Sumbersekar',
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
                    'role'      => $datauser['role'],
                    'logged_in' => true,
                ]);
                session()->setFlashdata('success', 'Login Berhasil, Selamat Bekerja. Semangat!!!');
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
            'title' => 'Register Page | Apotek Sumbersekar'
        ];
        return view('auth/register_page', $data);
    }

    public function proses_register()
    {
        $usermodel = new UserModel();
        $usermodel->insert([
            'nama_user' => $this->request->getVar('nama_user'),
            'username'  => $this->request->getVar('username'),
            'email'     => $this->request->getVar('email'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role'      => 'admin',
        ]);
        session()->getFlashdata('success', 'Register Berhasil');
        return redirect()->to(base_url('/'));
    }

    //------------------------------- Logout Controller -----------------------------------------
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    //------------------------------- Register Controller -----------------------------------------
    public function lupa_password()
    {
        return view('auth/lupa_password');
    }
}
