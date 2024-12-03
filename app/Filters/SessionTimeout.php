<?php

namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionTimeout implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->get('logged_in')) {
            $lastActivity = $session->get('last_activity');
            $currentTime = time();

            // Jika sesi tidak diaktivasi selama 
            if (($currentTime - $lastActivity) > 3600) {
                $session->destroy();
                $session->setFlashdata('pesan', 'Sesi telah selesai, silakan login kembali.');
                return redirect()->to('/login');
            }
        }
        $session->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

