<?php


// namespace App\Filters;

// use CodeIgniter\HTTP\RequestInterface;
// use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Filters\FilterInterface;

// class RoleFilter implements FilterInterface
// {
//     public function before(RequestInterface $request, $arguments = null)
//     {
//         $session = session();

//         if (!$session->get('logged_in')) {
//             // Jika pengguna tidak login, arahkan ke halaman login
//             return redirect()->to('/login')->with('pesan', 'Anda harus login terlebih dahulu.');
//         }

//         $akses = $session->get('akses');

//         // Mengatur logika akses berdasarkan role
//         if ($arguments && !in_array($akses, $arguments)) {
//             // Jika akses tidak sesuai dengan role yang diminta, arahkan kembali ke halaman login
//             return redirect()->to('/login')->with('pesan', 'Anda tidak memiliki akses.');
//         }
//     }

//     public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
//     {
//         // Tidak diperlukan untuk filter ini
//     }
// }
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            // Jika pengguna tidak login, arahkan ke halaman login
            return redirect()->to('/login')->with('pesan', 'Anda harus login terlebih dahulu.');
        }

        $akses = $session->get('akses');
        if ($arguments && !in_array($akses, $arguments)) {
            // Jika akses tidak sesuai dengan role yang diminta, arahkan kembali ke halaman login
            return redirect()->to('/login')->with('pesan', 'Anda tidak memiliki akses.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan untuk filter ini
    }
}

