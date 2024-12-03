<?php

namespace App\Controllers;

use App\Models\UserModel;

class login extends BaseController
{
    public function login()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        
        return view('Backend/login/login', $data);
    }

    public function login_action()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('Backend/login/login', $data);
        } else {
            $session = session();
            $usermodel = new UserModel();

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $cekUsername = $usermodel->where('username', $username)->first();

            if ($cekUsername) {
                $password_db = $cekUsername['password'];
                $verifikasi_pass = password_verify($password, $password_db);

                if ($verifikasi_pass) {
                    // Set session data
                    $session->set([
                        'user_id' => $cekUsername['id_user'],
                        'username' => $cekUsername['username'],
                        'nama' => $cekUsername['nama'],
                        'nip' => $cekUsername['nip'],
                        'akses' => $cekUsername['akses'],
                        'foto' => $cekUsername['foto'],
                        'logged_in' => true,
                        'last_activity' => time()
                    ]);

                    switch ($cekUsername['akses']) {
                        case "admin":
                            return redirect()->to('admin/dashboard');
                        case "user":
                            return redirect()->to('pegawai/dashboard');
                        default:
                            $session->setFlashdata('pesan', 'Anda tidak punya akun');
                            return redirect()->to('/login');
                    }
                } else {
                    $session->setFlashdata('pesan', 'Password salah, coba lagi');
                    return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('pesan', 'Username salah, coba lagi');
                return redirect()->to('/login');
            }
        }
    }

    public function logout()
    {
        // Hapus semua data sesi
        session()->destroy();

        // Arahkan kembali ke halaman beranda
        return redirect()->to('/');
    }
}
