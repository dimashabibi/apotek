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
        $token_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        date_default_timezone_set('Asia/Jakarta');
        $userData = [
            'nama_user' => $this->request->getPost('nama_user'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nohp' => $this->request->getPost('nohp'),
            'role' => 'admin',
            'verification_token' => $verificationToken,
            'token_expires' => $token_expires,
            'is_verified' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->userModel->insert($userData);

        // Send verification email
        $this->sendVerificationEmail($userData['email'], $verificationToken);

        return redirect()->to('/')->with('success', 'Registrasi Berhasil. Silahkan cek email yang terdaftar untuk verifikasi akun.');
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
            <p>Link ini akan kedaluwarsa dalam 1 jam.</p>
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
                'verification_token' => null,
                'token_expires' => null
            ]);

            return redirect()->to('/')->with('success', 'Email berhasil diverifikasi. Silahkan login.');
        }

        return redirect()->to('/')->with('error', 'Verifikasi gagal.');
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
                return redirect()->back()->with('error', 'Verifikasi email terlebih dahulu.');
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

            if (\session()->get('role') == 'admin') {
                return redirect()->to('/kasir')->with('success', 'Login successful');
            } else {
                return redirect()->to('/home')->with('success', 'Login successful');
            }
        }

        return redirect()->back()->with('error', 'Kredensial login tidak valid');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/')->with('success', 'Berhasil Keluar');
    }

    // Method untuk mengirim token reset password
    public function lupa_password()
    {
        // Tampilkan halaman lupa password
        return view('auth/lupa_password', [
            'title' => 'Lupa Password | Apotek Sumbersekar'
        ]);
    }

    // Proses permintaan reset password
    public function proses_lupa_password()
    {
        $email = $this->request->getVar('email');
        $users = $this->userModel->where('email', $email)->findAll();


        // Cek apakah email terdaftar
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Email tidak ditemukan');
        }

        $userList = "";
        foreach ($users as $user) {
            // Generate token unik untuk setiap akun
            $reset_token = bin2hex(random_bytes(32));
            $token_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Update token untuk masing-masing akun
            $this->userModel->update($user['id'], [
                'reset_token' => $reset_token,
                'token_expires' => $token_expires
            ]);

            // Buat daftar username dan link reset
            $reset_link = base_url('reset-password/' . $reset_token);
            $userList .= "Username : <strong>{$user['username']}</strong>\n <br>";
            $userList .= "Link Reset : {$reset_link}\n\n <br>";
        }


        $this->email->setFrom('no-reply@apoteksumbersekar.com', 'Apotek Sumbersekar');
        $this->email->setTo($email);
        $this->email->setSubject('Reset Password untuk Akun Anda');
        $this->email->setMessage("
        <html>
            <body>
                <h2>Reset Password</h2>
                <p>Anda menerima email ini karena ada permintaan reset password.</p>
                <p>Berikut adalah daftar akun yang terdaftar dengan email ini:</p>
                <p>{$userList}</p>
                <p>Setiap link akan kedaluwarsa dalam 1 jam.</p>
                <p>Abaikan email ini jika Anda tidak meminta reset password.</p>
            </body>
        </html>
        ");

        if ($this->email->send()) {
            return redirect()->back()
                ->with('success', 'Cek email Anda untuk instruksi reset password');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal mengirim email. Coba lagi.');
        }
    }

    // Halaman reset password
    public function reset_password($token)
    {
        // Cek token valid dan belum kedaluwarsa
        $user = $this->userModel
            ->where('reset_token', $token)
            ->where('token_expires >', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/lupa_password')
                ->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa');
        }

        return view('auth/reset_password', [
            'title' => 'Reset Password | Apotek Sumbersekar',
            'token' => $token,
            'username' => $user['username']
        ]);
    }

    // Proses reset password
    public function proses_reset_password()
    {
        $token = $this->request->getVar('token');
        $password_baru = $this->request->getVar('password_baru');
        $rules = \Config\Services::validation();

        // Validasi password
        $rules = [
            'password_baru' => [
                'label' => 'Password baru',
                'rules' => 'required|min_length[3]'
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('reset-password/' . $token)
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Cari user dengan token
        $user = $this->userModel
            ->where('reset_token', $token)
            ->where('token_expires >', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/lupa_password')
                ->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa');
        }

        // Update password dan hapus token
        $this->userModel->update($user['id'], [
            'password' => $password_baru,
            'reset_token' => null,
            'token_expires' => null
        ]);

        return redirect()->to('/')
            ->with('success', 'Password berhasil direset. Silakan login.');
    }

    // Kirim ulang konfirmasi email
    public function kirim_ulang_konfirmasi($user_id)
    {
        $user = $this->userModel->find($user_id);

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Pengguna tidak ditemukan');
        }

        // Generate token konfirmasi
        $konfirmasi_token = bin2hex(random_bytes(32));
        $token_expires = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // Simpan token di database
        $this->userModel->update($user_id, [
            'konfirmasi_token' => $konfirmasi_token,
            'token_expires' => $token_expires
        ]);

        // Kirim email konfirmasi
        $konfirmasi_link = base_url('konfirmasi-email/' . $konfirmasi_token);

        $this->email->setFrom('no-reply@apoteksumbersekar.com', 'Apotek Sumbersekar');
        $this->email->setTo($user['email']);
        $this->email->setSubject('Konfirmasi Alamat Email');
        $this->email->setMessage("
             Konfirmasi alamat email Anda dengan mengklik link berikut:
             
             {$konfirmasi_link}
             
             Link ini akan kedaluwarsa dalam 24 jam.
         ");

        if ($this->email->send()) {
            return redirect()->back()
                ->with('success', 'Email konfirmasi telah dikirim ulang');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal mengirim email konfirmasi');
        }
    }

    // Proses konfirmasi email
    public function konfirmasi_email($token)
    {
        $user = $this->userModel
            ->where('konfirmasi_token', $token)
            ->where('token_expires >', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/')
                ->with('error', 'Token konfirmasi tidak valid atau sudah kedaluwarsa');
        }

        // Update status email terkonfirmasi
        $this->userModel->update($user['id'], [
            'email_terverifikasi' => true,
            'konfirmasi_token' => null,
            'token_expires' => null
        ]);

        return redirect()->to('/')
            ->with('success', 'Email Anda berhasil dikonfirmasi');
    }
}
