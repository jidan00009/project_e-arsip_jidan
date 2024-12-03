<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $loggedIn = $session->get('logged_in');
        $userRole = $session->get('akses');
    
        if (!$session->get('logged_in')) {
            // Arahkan kembali ke halaman login
            return redirect()->to('/login')->with('pesan', 'Anda harus login terlebih dahulu.');
        }
        // Periksa jika pengguna tidak login atau tidak memiliki akses yang sesuai
        if (!$loggedIn || ($arguments && !in_array($userRole, $arguments))) {
            // Set flashdata dengan pesan
            $session->setFlashdata('pesan', 'Anda tidak memiliki akses ');
            
            
            // Arahkan kembali ke halaman login
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi yang diperlukan setelah permintaan
    }
}



