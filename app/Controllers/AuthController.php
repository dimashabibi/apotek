<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;
    protected $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->email = \Config\Services::email();
    }

    public function register()
    {
        return \view('auth/register_page');
    }


    public function proses_register()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama_user' => 'required',
            'username' => 'required|is_unique[user.username]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[3]',
            'nohp' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $verificationToken = bin2hex(random_bytes(32));

        date_default_timezone_set('Asia/Jakarta');
        $userData = [
            'nama_user' => $this->request->getPost('nama_user'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nohp' => $this->request->getPost('nohp'),
            'role' => 'admin',
            'verification_token' => $verificationToken,
            'is_verified' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->userModel->insert($userData);

        // Send verification email
        $this->sendVerificationEmail($userData['email'], $verificationToken);

        return redirect()->to('/')->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    private function sendVerificationEmail($email, $token)
    {
        $this->email->setFrom('noreply@apoteksumbersekar.com', 'Apotek Sumbersekar');
        $this->email->setTo($email);
        $this->email->setSubject('Email Verification');

        $verificationLink = site_url('verify-email/' . $token);
        $message = "
        <html>
        <body>
            <h2>Email Verification</h2>
            <p>Terima kasih telah mendaftar di Apotek Sumbersekar.</p>
            <p>Silakan klik link di bawah ini untuk memverifikasi email Anda:</p>
            <p><a href='{$verificationLink}'>Verifikasi Email</a></p>
            <p>Atau salin link berikut: {$verificationLink}</p>
        </body>
        </html>
        ";

        $this->email->setMessage($message);
        $this->email->send();
    }

    public function verifyEmail($token)
    {
        $user = $this->userModel->getUserByVerificationToken($token);

        if ($user) {
            $this->userModel->update($user['id'], [
                'is_verified' => 1,
                'verification_token' => null
            ]);

            return redirect()->to('/')->with('success', 'Email verified successfully. You can now login.');
        }

        return redirect()->to('/')->with('error', 'Invalid verification token.');
    }

    public function index()
    {
        return view('auth/login_page');
    }

    public function proses_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('username', $username)->first();

        // Debug: Periksa apakah user ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Debug: Periksa password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        if ($user && password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 0) {
                return redirect()->back()->with('error', 'Please verify your email first.');
            }

            $session = session();
            $sessionData = [
                'id' => $user['id'],
                'username' => $user['username'],
                'nama_user' => $user['nama_user'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ];
            $session->set($sessionData);

            return redirect()->to('/kasir')->with('success', 'Login successful');
        }

        return redirect()->back()->with('error', 'Invalid login credentials');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/')->with('success', 'Logged out successfully');
    }
}
