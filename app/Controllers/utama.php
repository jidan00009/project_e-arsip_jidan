<?php

namespace App\Controllers;
use App\Models\DokumenModel;
use App\Models\JenisDokumenModel;
use App\Models\KategoriDokumenModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
class utama extends BaseController
{
    public function dataDokumen()
    {
        // Inisialisasi model
        $dokumenModel = new DokumenModel();
        $jenisDokumenModel = new JenisDokumenModel();
        $kategoriDokumenModel = new KategoriDokumenModel();

        // Mengambil data dari database
        $dokumendata = $dokumenModel->findAll();
        $jenis = $jenisDokumenModel->findAll();
        $kategori = $kategoriDokumenModel->findAll();

        // Membuat array asosiasi untuk jenis dokumen
        $jenisArray = [];
        foreach ($jenis as $item) {
            $jenisArray[$item['id_jenis']] = $item['nama_jenis'];
        }

        // Menggabungkan data dokumen dengan jenis dan kategori
        foreach ($dokumendata as &$dokumen) {
            $dokumen['jenis'] = $jenisArray[$dokumen['id_jenis']] ?? 'Tidak diketahui';
            $dokumen['nama_kategori'] = array_column($kategori, 'nama_kategori', 'id_kategori')[$dokumen['id_kategori']] ?? 'Tidak diketahui';
        }

        // Mengembalikan data dalam format yang diinginkan
        return ['isi' => $dokumendata, 'kategori' => $kategori , 'jenis' => $jenisArray];
    }   
   
        public function dashboard()
        {
            // Memanggil metode dataDokumen() untuk menginisialisasi data dokumen
            $data = $this->dataDokumen();
        
            // Ambil jenis dokumen yang dipilih dari parameter URL
            $jenisDokumenDipilih = $this->request->getGet('jenis');
        
            // Jika jenis dokumen sudah dipilih
            if ($jenisDokumenDipilih && $jenisDokumenDipilih !== 'All') {
                // Filter data sesuai dengan jenis dokumen yang dipilih
                $data['filteredData'] = array_filter($data['isi'], function ($dokumen) use ($jenisDokumenDipilih) {
                    return $dokumen['jenis'] === $jenisDokumenDipilih;
                });
            } else {
                // Jika tidak ada jenis dokumen yang dipilih atau jika jenis dokumen adalah 'All', tampilkan semua data
                $data['filteredData'] = $data['isi'];
            }
        
            // Menyimpan jenis dokumen yang dipilih ke dalam data yang dikirim ke view
            $data['jenisDipilih'] = $jenisDokumenDipilih;
        
            // Ambil role pengguna dari sesi
            $role = session()->get('akses');
        
            // Tentukan view yang akan ditampilkan berdasarkan peran pengguna
            $sidebarView = ($role == 'admin') ? 'Backend/template/sidebar' : 'Backend/template/sidebar';
            $headerView = ($role == 'admin') ? 'Backend/template/header' : 'Backend/template/header';
            $dashboardView = ($role == 'admin') ? 'Backend/login/Dashboard' : 'Backend/login/Dashboard';
            
            // Tampilkan view
            echo view($sidebarView, $data);
            echo view($headerView);
            echo view($dashboardView, $data);
            echo view('Backend/template/footer'); // Gunakan footer yang sesuai jika diperlukan
        }
        
       
    
    
}