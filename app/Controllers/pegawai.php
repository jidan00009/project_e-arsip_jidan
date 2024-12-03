<?php

namespace App\Controllers;
use App\Models\DokumenModel;
use App\Models\JenisDokumenModel;
use App\Models\KategoriDokumenModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class pegawai extends BaseController
{
   

    //================================================================
    // public function dashboard()
    // {
    //     // Memanggil metode dataDokumen() untuk menginisialisasi data dokumen
    //     $data = $this->dataDokumen();
    
    //     // Ambil jenis dokumen yang dipilih dari parameter URL
    //     $jenisDokumenDipilih = $this->request->getGet('jenis');
    
    //     // Jika jenis dokumen sudah dipilih
    //     if ($jenisDokumenDipilih && $jenisDokumenDipilih !== 'All') {
    //         // Filter data sesuai dengan jenis dokumen yang dipilih
    //         $data['filteredData'] = array_filter($data['isi'], function ($dokumen) use ($jenisDokumenDipilih) {
    //             return $dokumen['jenis'] === $jenisDokumenDipilih;
    //         });
    //     } else {
    //         // Jika tidak ada jenis dokumen yang dipilih atau jika jenis dokumen adalah 'All', tampilkan semua data
    //         $data['filteredData'] = $data['isi'];
    //     }
    
    //     // Menyimpan jenis dokumen yang dipilih ke dalam data yang dikirim ke view
    //     $data['jenisDipilih'] = $jenisDokumenDipilih;
    
    //     // Tampilkan view
    //     echo view('Backend/template/sidebar', $data);
    //     echo view('Backend/template/headerpegawai');
    //     echo view('Backend/login/Dashboard', $data);
    //     echo view('Backend/template/footer');
    // }
    public function dashboard()
    {
        // Memanggil metode dataDokumen() untuk menginisialisasi data dokumen
        $data = $this->dataDokumen();
    
        // Ambil jenis dokumen dan tahun yang dipilih dari parameter URL
        $jenisDokumenDipilih = $this->request->getGet('jenis');
        $tahunDipilih = $this->request->getGet('tahun');
    
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
    
        // Filter data sesuai dengan tahun yang dipilih
        if ($tahunDipilih) {
            $data['filteredData'] = array_filter($data['filteredData'], function ($dokumen) use ($tahunDipilih) {
                return $dokumen['tahun'] === $tahunDipilih;
            });
        }
    
        // Urutkan data berdasarkan waktu_update dari yang terbaru
        usort($data['filteredData'], function ($a, $b) {
            return strtotime($b['waktu_update']) - strtotime($a['waktu_update']);
        });
    
        // Menyimpan jenis dokumen dan tahun yang dipilih ke dalam data yang dikirim ke view
        $data['jenisDipilih'] = $jenisDokumenDipilih;
        $data['tahunDipilih'] = $tahunDipilih;
    
        //     // Tampilkan view
        echo view('Backend/template/sidebar', $data);
        echo view('Backend/template/headerpegawai');
        echo view('Backend/login/Dashboard', $data);
        echo view('Backend/template/footer');
    }    
//-------------------------------------------------------------------------
public function jenisdoc()
{
    // Memanggil metode tabel() untuk menginisialisasi data buku
    $data = $this->dataDokumen();

    // Ambil jenis dokumen yang dipilih dari parameter URL
    $jenisDokumenDipilih = $this->request->getGet('jenis');

    // Jika jenis dokumen sudah dipilih
    if ($jenisDokumenDipilih) {
        // Filter data sesuai dengan jenis dokumen yang dipilih
        $data['filteredData'] = array_filter($data['isi'], function ($dokumen) use ($jenisDokumenDipilih) {
            return $dokumen['jenis'] === $jenisDokumenDipilih;
        });
    } else {
        // Jika tidak ada jenis dokumen yang dipilih, tampilkan semua data
        $data['filteredData'] = $data['isi'];
    }

    // Memeriksa apakah data dokumen ada sebelum mengaksesnya
    if (!isset($data['isi'])) {
        // Tindakan jika data dokumen tidak tersedia
        echo "Data dokumen tidak tersedia.";
        return;
    }

    // Menyimpan jenis dokumen yang dipilih ke dalam data yang dikirim ke view
    $data['jenisDipilih'] = $jenisDokumenDipilih;

    // Tampilkan view jenisdoc
    echo view('Backend/template/sidebar', $data);
    echo view('Backend/template/headerpegawai');
    echo view('Backend/login/jenisdoc', $data);
    echo view('Backend/template/footer');
}

    
//-------------------------------------------------------------------------------------------
    //      public function dataDokumen()
    // {
    //     // Inisialisasi model
    //     $dokumenModel = new DokumenModel();
    //     $jenisDokumenModel = new JenisDokumenModel();
    //     $kategoriDokumenModel = new KategoriDokumenModel();

    //     // Mengambil data dari database
    //     $dokumendata = $dokumenModel->findAll();
    //     $jenis = $jenisDokumenModel->findAll();
    //     $kategori = $kategoriDokumenModel->findAll();

    //     // Membuat array asosiasi untuk jenis dokumen
    //     $jenisArray = [];
    //     foreach ($jenis as $item) {
    //         $jenisArray[$item['id_jenis']] = $item['nama_jenis'];
    //     }

    //     // Menggabungkan data dokumen dengan jenis dan kategori
    //     foreach ($dokumendata as &$dokumen) {
    //         $dokumen['jenis'] = $jenisArray[$dokumen['id_jenis']] ?? 'Tidak diketahui';
    //         $dokumen['nama_kategori'] = array_column($kategori, 'nama_kategori', 'id_kategori')[$dokumen['id_kategori']] ?? 'Tidak diketahui';
    //     }

    //     // Mengembalikan data dalam format yang diinginkan
    //     return ['isi' => $dokumendata, 'kategori' => $kategori , 'jenis' => $jenisArray];
    // }   
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

    // Ambil tahun-tahun unik dari database
    $tahun = $dokumenModel->select('tahun')
                          ->distinct()
                          ->orderBy('tahun', 'DESC')
                          ->findAll();

    // Mengembalikan data dalam format yang diinginkan
    return [
        'isi' => $dokumendata,
        'kategori' => $kategori,
        'jenis' => $jenisArray,
        'tahun' => $tahun // Tambahkan tahun ke data yang dikirim ke view
    ];
}

//------------------------------------------------------------------------------------------------
public function tambahdoc()
{
    // Memanggil metode datadami() untuk mengambil data jenis dan kategori
    $data = $this->dataDokumen();

    // Tampilkan view form tambah dokumen
    echo view('Backend/template/sidebar', $data);
    echo view('Backend/template/headerpegawai');
    echo view('Backend/login/tambahdoc');
    echo view('Backend/template/footer');
}

  
// public function simpandoc()
// {
//     $dokumenModel = new DokumenModel();
//     $jenisDokumenModel = new JenisDokumenModel();
//     $kategoriDokumenModel = new KategoriDokumenModel();

//     // Validasi input
//     if (!$this->validate([
//         'judul_dokumen' => 'required',
//         'tahun' => [
//             'required',
//             'regex_match[/^\d{4}$/]', // Validasi untuk format tahun (4 digit angka)
//         ],
//         'jenis' => 'required',
//         'nama_kategori' => 'required',
//         'file' => 'uploaded[file]|mime_in[file,application/pdf]',
//         'keterangan' => 'required'
//     ])) {
//         // Menampilkan pesan error validasi
//         $errors = $this->validator->getErrors();
//         return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'Gagal validasi: ' . implode(', ', $errors));
//     }

//     // Ambil file yang diupload
//     $file = $this->request->getFile('file');

//     // Debugging file
//     if (!$file->isValid()) {
//         $error = $file->getErrorString() . ' (' . $file->getError() . ')';
//         return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'File tidak valid: ' . $error);
//     }

//     // if ($file->hasMoved()) {
//     //     return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'File sudah dipindahkan.');
//     // }

//     // Pindahkan file ke direktori tujuan
//     $fileName = $file->getName(); // Gunakan nama asli file
//     $file->move(ROOTPATH . 'public/fileArsip', $fileName);

//     // Ambil nama jenis dan nama kategori dari form
//     $namaJenis = $this->request->getPost('jenis');
//     $namaKategori = $this->request->getPost('nama_kategori');

//     // Cari id_jenis dan id_kategori berdasarkan nama
//     $jenisItem = $jenisDokumenModel->where('nama_jenis', $namaJenis)->first();
//     $kategoriItem = $kategoriDokumenModel->where('nama_kategori', $namaKategori)->first();

//     if (!$jenisItem || !$kategoriItem) {
//         return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'Jenis atau Kategori tidak valid.');
//     }

//     // Simpan data ke database menggunakan insert
//     $dokumenData = [
//         'nama_dokumen' => $this->request->getPost('judul_dokumen'),
//         'id_jenis' => $jenisItem['id_jenis'],
//         'id_kategori' => $kategoriItem['id_kategori'],
//         'tahun' => $this->request->getPost('tahun'),
//         'file' => $fileName, // Simpan nama file tanpa enkripsi
//         'filesize' => $file->getSize(),
//         //'waktu_upload' => date('Y-m-d H:i:s'),
//         //'waktu_update' => date('Y-m-d H:i:s'),
//         'keterangan' => $this->request->getPost('keterangan')
//     ];

//     if ($dokumenModel->insert($dokumenData)) {
//         // Redirect ke halaman sukses dengan pesan
//         return redirect()->to('/pegawai/tambahdoc')->with('success', 'Dokumen berhasil disimpan.');
//     } else {
//         // Redirect ke halaman tambah dokumen dengan pesan error
//         return redirect()->to('/pegawai/tambahdoc')->with('error', 'Gagal menyimpan dokumen.');
//     }
// }



public function simpandoc()
{
    $dokumenModel = new DokumenModel();
    $jenisDokumenModel = new JenisDokumenModel();
    $kategoriDokumenModel = new KategoriDokumenModel();

    // Validasi input
    if (!$this->validate([
        'judul_dokumen' => 'required',
        'tahun' => [
            'required',
            'regex_match[/^\d{4}$/]', // Validasi untuk format tahun (4 digit angka)
        ],
        'jenis' => 'required',
        'nama_kategori' => 'required',
        'file' => [
            'uploaded[file]',
            'mime_in[file,application/pdf]',
            'max_size[file,100000]', 
        ],
    ])) {
        // Menampilkan pesan error validasi
        $errors = $this->validator->getErrors();
        return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'Gagal validasi: ' . implode(', ', $errors));
    }

    // Ambil file yang diupload
    $file = $this->request->getFile('file');

    // Debugging file
    if (!$file->isValid()) {
        $error = $file->getErrorString() . ' (' . $file->getError() . ')';
        return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'File tidak valid: ' . $error);
    }

    // Cek apakah file dengan nama yang sama sudah ada
    $fileName = $file->getName(); // Gunakan nama asli file
    if (file_exists(ROOTPATH . 'public/fileArsip/' . $fileName)) {
        return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'File dengan nama yang sama sudah ada.');
    }

    // Pindahkan file ke direktori tujuan
    $file->move(ROOTPATH . 'public/fileArsip', $fileName);

    // Ambil nama jenis dan nama kategori dari form
    $namaJenis = $this->request->getPost('jenis');
    $namaKategori = $this->request->getPost('nama_kategori');

    // Cari id_jenis dan id_kategori berdasarkan nama
    $jenisItem = $jenisDokumenModel->where('nama_jenis', $namaJenis)->first();
    $kategoriItem = $kategoriDokumenModel->where('nama_kategori', $namaKategori)->first();

    if (!$jenisItem || !$kategoriItem) {
        return redirect()->to('/pegawai/tambahdoc')->withInput()->with('error', 'Jenis atau Kategori tidak valid.');
    }

    // Ambil id_user dari session
    $userId = session()->get('user_id');
    if (is_null($userId)) {
        return redirect()->to('/pegawai/tambahdoc')->with('error', 'ID pengguna tidak ditemukan di session.');
    }

    // Simpan data ke database menggunakan insert
    $dokumenData = [
        'id_user' => $userId,  // Simpan user_id ke dalam database
        'nama_dokumen' => $this->request->getPost('judul_dokumen'),
        'id_jenis' => $jenisItem['id_jenis'],
        'id_kategori' => $kategoriItem['id_kategori'],
        'tahun' => $this->request->getPost('tahun'),
        'file' => $fileName, // Simpan nama file tanpa enkripsi
        'filesize' => $file->getSize(),
        'keterangan' => $this->request->getPost('keterangan')
    ];

    if ($dokumenModel->insert($dokumenData)) {
        // Redirect ke halaman sukses dengan pesan
        return redirect()->to('/pegawai/tambahdoc')->with('success', 'Dokumen berhasil disimpan.');
    } else {
        // Redirect ke halaman tambah dokumen dengan pesan error
        return redirect()->to('/pegawai/tambahdoc')->with('error', 'Gagal menyimpan dokumen.');
    }
}

//-----------------------------------------------------------------------------------------------
public function editdoc($id_dokumen)
{
    $dokumenModel = new DokumenModel();
    $jenisDokumenModel = new JenisDokumenModel();
    $kategoriDokumenModel = new KategoriDokumenModel();

    // Ambil data dokumen
    $dokumen = $dokumenModel->find($id_dokumen);

    if (!$dokumen) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Dokumen tidak ditemukan');
    }

    // Ambil data jenis dan kategori dokumen
    $jenisDokumen = $jenisDokumenModel->findAll();
    $kategoriDokumen = $kategoriDokumenModel->findAll();

    // Set status edit aktif
    session()->setFlashdata('edit_active', true);
// Memanggil metode tabel() untuk menginisialisasi data buku
$data = $this->dataDokumen();
    // Tampilkan form edit dokumen
   echo view('Backend/template/sidebar',$data);
    echo view('Backend/template/headerpegawai');
    echo view('Backend/login/editdoc', [
        'dokumen' => $dokumen,
        'jenis' => $jenisDokumen,
        'kategori' => $kategoriDokumen
    ]);
    echo view('Backend/template/footer');
}

public function updatedoc($id_dokumen)
{
    $dokumenModel = new DokumenModel();
    $jenisDokumenModel = new JenisDokumenModel();
    $kategoriDokumenModel = new KategoriDokumenModel();

    // Validasi input tanpa memperhatikan file
    if (!$this->validate([
        'judul_dokumen' => 'required',
        'tahun' => [
            'required',
            'regex_match[/^\d{4}$/]',
        ],
        'jenis' => 'required',
        'nama_kategori' => 'required',
        'file' => 'mime_in[file,application/pdf]|max_size[file,512000]', // Validasi file diabaikan jika tidak ada file baru
        //'keterangan' => 'required' // Uncomment jika keterangan wajib diisi
    ])) {
        return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->withInput()->with('error', 'Gagal validasi: ' . implode(', ', $this->validator->getErrors()));
    }

    // Ambil data dokumen yang ada
    $existingDokumen = $dokumenModel->find($id_dokumen);

    // Ambil file yang diupload, jika ada
    $file = $this->request->getFile('file');
    $fileName = $existingDokumen['file']; // Gunakan nama file yang ada secara default
    $fileSize = $existingDokumen['filesize']; // Gunakan ukuran file yang ada secara default

    // Periksa jika file diupload dan valid
    if ($file->isValid() && !$file->hasMoved()) {
        if (!empty($existingDokumen['file']) && file_exists(ROOTPATH . 'public/fileArsip/' . $existingDokumen['file'])) {
            unlink(ROOTPATH . 'public/fileArsip/' . $existingDokumen['file']);
        }

        $fileName = $file->getName();
        $file->move(ROOTPATH . 'public/fileArsip', $fileName);
        $fileSize = $file->getSize(); // Perbarui ukuran file hanya jika file baru diupload
    }

    // Ambil nama jenis dan kategori dari input
    $namaJenis = $this->request->getPost('jenis');
    $namaKategori = $this->request->getPost('nama_kategori');
    
    // Cari ID jenis dan kategori berdasarkan nama
    $jenisItem = $jenisDokumenModel->where('nama_jenis', $namaJenis)->first();
    $kategoriItem = $kategoriDokumenModel->where('nama_kategori', $namaKategori)->first();

    if (!$jenisItem || !$kategoriItem) {
        return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->withInput()->with('error', 'Jenis atau Kategori tidak valid.');
    }

    // Ambil user_id dari session
    $userId = session()->get('user_id');
    if (is_null($userId)) {
        return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->with('error', 'ID pengguna tidak ditemukan di session.');
    }

    // Data dokumen yang akan diupdate
    $dokumenData = [
        'id_user' => $userId, // Menggunakan user_id yang sedang login
        'nama_dokumen' => $this->request->getPost('judul_dokumen'),
        'id_jenis' => $jenisItem['id_jenis'],
        'id_kategori' => $kategoriItem['id_kategori'],
        'tahun' => $this->request->getPost('tahun'),
        'file' => $fileName, // Gunakan nama file terbaru jika file telah diupload
        'filesize' => $fileSize, // Gunakan ukuran file terbaru jika file telah diupload
        'keterangan' => $this->request->getPost('keterangan')
    ];

    // Update dokumen di database
    if ($dokumenModel->update($id_dokumen, $dokumenData)) {
        return redirect()->to('/pegawai/lihatdoc/' . $id_dokumen)->with('success', 'Dokumen berhasil diperbarui.');
    } else {
        return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->with('error', 'Gagal memperbarui dokumen.');
    }
}

// public function updatedoc($id_dokumen)
// {
//     $dokumenModel = new DokumenModel();
//     $jenisDokumenModel = new JenisDokumenModel();
//     $kategoriDokumenModel = new KategoriDokumenModel();

//     if ($this->validate([
//         'judul_dokumen' => 'required',
//         'tahun' => [
//             'required',
//             'regex_match[/^\d{4}$/]',
//         ],
//         'jenis' => 'required',
//         'nama_kategori' => 'required',
//         'file' => 'mime_in[file,application/pdf]|max_size[file,2048]',
//         'keterangan' => 'required'
//     ])) {
//         $existingDokumen = $dokumenModel->find($id_dokumen);
//         $file = $this->request->getFile('file');
//         $fileName = $existingDokumen['file']; // Default to existing file

//         if ($file->isValid() && !$file->hasMoved()) {
//             if (!empty($existingDokumen['file']) && file_exists(ROOTPATH . 'public/fileArsip/' . $existingDokumen['file'])) {
//                 unlink(ROOTPATH . 'public/fileArsip/' . $existingDokumen['file']);
//             }
//             $fileName = $file->getName();
//             $file->move(ROOTPATH . 'public/fileArsip', $fileName);
//         }

//         $namaJenis = $this->request->getPost('jenis');
//         $namaKategori = $this->request->getPost('nama_kategori');
//         $jenisItem = $jenisDokumenModel->where('nama_jenis', $namaJenis)->first();
//         $kategoriItem = $kategoriDokumenModel->where('nama_kategori', $namaKategori)->first();

//         if (!$jenisItem || !$kategoriItem) {
//             return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->withInput()->with('error', 'Jenis atau Kategori tidak valid.');
//         }

//         $dokumenData = [
//             'nama_dokumen' => $this->request->getPost('judul_dokumen'),
//             'id_jenis' => $jenisItem['id_jenis'],
//             'id_kategori' => $kategoriItem['id_kategori'],
//             'tahun' => $this->request->getPost('tahun'),
//             'file' => $fileName,
//             'filesize' => $file ? $file->getSize() : $existingDokumen['filesize'],
//             // 'waktu_upload' => date('Y-m-d H:i:s'), // Tetap sama
//             // 'waktu_update' => date('Y-m-d H:i:s'), // Perbarui waktu update
//             'keterangan' => $this->request->getPost('keterangan')
//         ];

//         if ($dokumenModel->update($id_dokumen, $dokumenData)) {
//             return redirect()->to('/pegawai/lihatdoc/' . $id_dokumen)->with('success', 'Dokumen berhasil diperbarui.');
//         } else {
//             return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->with('error', 'Gagal memperbarui dokumen.');
//         }
//     }

//     return redirect()->to('/pegawai/editdoc/' . $id_dokumen)->withInput()->with('error', 'Gagal validasi atau upload file.');
// }





    //--------------------------------------------------------------------------------------
    public function tambahjenis()
    {
        // Memanggil metode dataJenisDokumen() untuk menginisialisasi data jenis dokumen
        $data = $this->dataJenisDokumen();

      

        // Menambahkan variabel $jenis untuk view sidebar
        $data['jenis'] = array_column($data['isi'], 'nama_jenis');

        echo view('Backend/template/sidebar', $data);
        echo view('Backend/template/headerpegawai');
        echo view('Backend/login/tambahjenis', $data);
        echo view('Backend/template/footer');
    }

    public function simpanjenis()
    {
        // Inisialisasi model
        $jenisDokumenModel = new JenisDokumenModel();

        // Mendapatkan data dari form
        $namaJenis = $this->request->getPost('jenis');

        // Mengecek apakah nama jenis dokumen sudah ada di database
        $existingJenis = $jenisDokumenModel->where('nama_jenis', $namaJenis)->first();

        if ($existingJenis) {
            // Redirect ke halaman tambah jenis dengan pesan error
            return redirect()->to('/pegawai/tambahjenis')->with('error', 'Jenis dokumen sudah ada');
        }

        // Menyimpan data ke database
        $data = [
            'nama_jenis' => $namaJenis
        ];

        if ($jenisDokumenModel->insert($data)) {
            // Redirect ke halaman tambah jenis dengan pesan sukses
            return redirect()->to('/pegawai/tambahjenis')->with('success', 'Jenis dokumen berhasil ditambahkan');
        } else {
            // Redirect ke halaman tambah jenis dengan pesan error
            return redirect()->to('/pegawai/tambahjenis')->with('error', 'Jenis dokumen gagal ditambahkan');
        }
    }

    public function hapusjenis($id)
{
    // Inisialisasi model
    $jenisDokumenModel = new JenisDokumenModel();
    $dokumenModel = new DokumenModel(); // Anggap DokumenModel sebagai model untuk tabel 'dokumen'

    // Periksa apakah jenis dokumen memiliki dokumen terkait
    $countDokumen = $dokumenModel->where('id_jenis', $id)->countAllResults();

    if ($countDokumen > 0) {
        // Jika ada dokumen terkait, tampilkan pesan error atau lakukan penanganan lainnya
        return redirect()->to('/pegawai/tambahjenis')->with('error', 'Tidak dapat menghapus jenis dokumen ini karena masih terdapat dokumen yang menggunakan jenis ini.');
    }

    // Jika tidak ada dokumen terkait, lanjutkan untuk menghapus jenis dokumen
    if ($jenisDokumenModel->delete($id)) {
        return redirect()->to('/pegawai/tambahjenis')->with('success', 'Jenis dokumen berhasil dihapus');
    } else {
        return redirect()->to('/pegawai/tambahjenis')->with('error', 'Gagal menghapus jenis dokumen');
    }
}

public function editjenis($id)
{
     // Memanggil metode dataJenisDokumen() untuk menginisialisasi data jenis dokumen
     $data = $this->dataJenisDokumen();
    // Inisialisasi model dan mendapatkan data jenis dokumen berdasarkan $id
    $jenisDokumenModel = new JenisDokumenModel();
    $data['jenis'] = $jenisDokumenModel->find($id);

    if (!$data['jenis']) {
        // Tampilkan pesan error atau alihkan ke halaman lain jika jenis dokumen tidak ditemukan
        return redirect()->to('/pegawai/tambahjenis')->with('error', 'Jenis dokumen tidak ditemukan');
    }

    // Memuat data jenis dokumen untuk ditampilkan di form edit
    $data['data'] = $this->dataJenisDokumen();

    echo view('Backend/template/sidebar1');
    echo view('Backend/template/headerpegawai');
    echo view('Backend/login/editjenis', $data); // Pastikan path ini sesuai dengan struktur direktori Anda
    echo view('Backend/template/footer');
}


public function updatejenis($id)
{
    // Inisialisasi model
    $jenisDokumenModel = new JenisDokumenModel();

    // Mendapatkan data dari form
    $namaJenis = $this->request->getPost('jenis');

    // Mengecek apakah nama jenis dokumen sudah ada di database (kecuali untuk jenis dengan id yang sedang diedit)
    $existingJenis = $jenisDokumenModel->where('nama_jenis', $namaJenis)->where('id_jenis !=', $id)->first();

    if ($existingJenis) {
        // Redirect ke halaman edit jenis dengan pesan error
        return redirect()->to('/pegawai/editjenis/'.$id)->with('error', 'Jenis dokumen sudah ada');
    }

    // Data baru untuk update
    $data = [
        'nama_jenis' => $namaJenis
    ];

    // Melakukan update
    if ($jenisDokumenModel->update($id, $data)) {
        // Redirect ke halaman tambah jenis dengan pesan sukses
        return redirect()->to('/pegawai/tambahjenis')->with('success', 'Jenis dokumen berhasil diperbarui');
    } else {
        // Redirect ke halaman tambah jenis dengan pesan error
        return redirect()->to('/pegawai/editjenis/'.$id)->with('error', 'Gagal memperbarui jenis dokumen');
    }
}

    private function dataJenisDokumen()
    {
        $jenisDokumenModel = new JenisDokumenModel();
        $data['isi'] = $jenisDokumenModel->findAll(); // Pastikan ini hanya mengembalikan data dari tabel jenisdokumen
        return $data;
    }
// ---------------------------------------------------------------------------------------------------------

public function tambahkategori()
{
    // Inisialisasi data kategori dokumen
    $data = $this->dataKategoriDokumen();

    // Memanggil metode dataJenisDokumen() untuk menginisialisasi data jenis dokumen
    $jenisData = $this->dataJenisDokumen();

    // Menambahkan variabel $jenis untuk view sidebar
    $data['jenis'] = array_column($jenisData['isi'], 'nama_jenis');

    echo view('Backend/template/sidebar', $data);
    echo view('Backend/template/headerpegawai');
    echo view('Backend/login/tambahkategori', $data);
    echo view('Backend/template/footer');
}




public function simpankategori()
{
    // Inisialisasi model
    $kategoriDokumenModel = new KategoriDokumenModel();

    // Mendapatkan data dari form
    $namaKategori = $this->request->getPost('kategori');

    // Mengecek apakah nama kategori dokumen sudah ada di database
    $existingKategori = $kategoriDokumenModel->where('nama_kategori', $namaKategori)->first();

    if ($existingKategori) {
        // Redirect ke halaman tambah kategori dengan pesan error
        return redirect()->to('/pegawai/tambahkategori')->with('error', 'Kategori dokumen sudah ada');
    }

    // Menyimpan data ke database
    $data = [
        'nama_kategori' => $namaKategori
    ];

    if ($kategoriDokumenModel->insert($data)) {
        // Redirect ke halaman tambah kategori dengan pesan sukses
        return redirect()->to('/pegawai/tambahkategori')->with('success', 'Kategori dokumen berhasil ditambahkan');
    } else {
        // Redirect ke halaman tambah kategori dengan pesan error
        return redirect()->to('/pegawai/tambahkategori')->with('error', 'Kategori dokumen gagal ditambahkan');
    }
}

public function hapuskategori($id)
{
    // Inisialisasi model
    $kategoriDokumenModel = new KategoriDokumenModel();
    $dokumenModel = new DokumenModel(); // Assuming DokumenModel is the model for 'dokumen' table

    // Periksa apakah kategori dokumen memiliki dokumen terkait
    $countDokumen = $dokumenModel->where('id_kategori', $id)->countAllResults();

    if ($countDokumen > 0) {
        // Jika ada dokumen terkait, tampilkan pesan error atau lakukan penanganan lainnya
        return redirect()->to('/pegawai/tambahkategori')->with('error', 'Tidak dapat menghapus kategori dokumen ini karena masih terdapat dokumen yang menggunakan kategori ini.');
    }

    // Jika tidak ada dokumen terkait, lanjutkan untuk menghapus kategori dokumen
    if ($kategoriDokumenModel->delete($id)) {
        return redirect()->to('/pegawai/tambahkategori')->with('success', 'Kategori dokumen berhasil dihapus');
    } else {
        return redirect()->to('/pegawai/tambahkategori')->with('error', 'Gagal menghapus kategori dokumen');
    }
}

public function editkategori($id)
{
    // Inisialisasi model dan mendapatkan data kategori dokumen berdasarkan $id
    $kategoriDokumenModel = new KategoriDokumenModel();
    $data['kategori'] = $kategoriDokumenModel->find($id);

    if (!$data['kategori']) {
        // Tampilkan pesan error atau alihkan ke halaman lain jika kategori dokumen tidak ditemukan
        return redirect()->to('/pegawai/tambahkategori')->with('error', 'Kategori dokumen tidak ditemukan');
    }

    // Memuat data kategori dokumen untuk ditampilkan di form edit
    $data['data'] = $this->dataKategoriDokumen();

    

    echo view('Backend/template/headerpegawai');
    echo view('Backend/template/sidebar1');
    echo view('Backend/login/editkategori', $data); // Pastikan path ini sesuai dengan struktur direktori Anda
    echo view('Backend/template/footer');
}

public function updatekategori($id)
{
    // Inisialisasi model
    $kategoriDokumenModel = new KategoriDokumenModel();

    // Mendapatkan data dari form
    $namaKategori = $this->request->getPost('kategori');

    // Mengecek apakah nama kategori dokumen sudah ada di database (kecuali untuk kategori dengan id yang sedang diedit)
    $existingKategori = $kategoriDokumenModel->where('nama_kategori', $namaKategori)->where('id_kategori !=', $id)->first();

    if ($existingKategori) {
        // Redirect ke halaman edit kategori dengan pesan error
        return redirect()->to('/pegawai/editkategori/'.$id)->with('error', 'Kategori dokumen sudah ada');
    }

    // Data baru untuk update
    $data = [
        'nama_kategori' => $namaKategori
    ];

    // Melakukan update
    if ($kategoriDokumenModel->update($id, $data)) {
        // Redirect ke halaman tambah kategori dengan pesan sukses
        return redirect()->to('/pegawai/tambahkategori')->with('success', 'Kategori dokumen berhasil diperbarui');
    } else {
        // Redirect ke halaman tambah kategori dengan pesan error
        return redirect()->to('/pegawai/editkategori/'.$id)->with('error', 'Gagal memperbarui kategori dokumen');
    }
}

    private function dataKategoriDokumen()
    {
        $kategoriDokumenModel = new KategoriDokumenModel();
        $data['isi'] = $kategoriDokumenModel->findAll();
        return $data;
    }

    public function lihatdoc($id)
    {
        $dokumenModel = new DokumenModel();
        $userModel = new UserModel(); // Inisialisasi UserModel
        $dokumen = $dokumenModel->find($id);
        
        if ($dokumen) {
            $jenisModel = new JenisDokumenModel();
            $kategoriModel = new KategoriDokumenModel();

            $jenis = $jenisModel->find($dokumen['id_jenis']); // Ambil data jenis dokumen
            $kategori = $kategoriModel->find($dokumen['id_kategori']); // Ambil data kategori dokumen
            
            // Ambil nama pengguna berdasarkan id_user
            $user = $userModel->find($dokumen['id_user']);
            $namaUser = $user ? $user['nama'] : 'Tidak Diketahui'; // Nama pengguna atau default

            // Siapkan data untuk dikirimkan ke view
            $data = [
                'dokumen' => $dokumen,
                'nama_jenis' => $jenis['nama_jenis'],
                'nama_kategori' => $kategori['nama_kategori'],
                'nama_user' => $namaUser // Tambahkan nama pengguna ke data
            ];

            // Pastikan parameter jenis dipertahankan
            $jenisDipilih = $this->request->getGet('jenis') ?? 'All';
            $data['jenisDipilih'] = $jenisDipilih;

            // Load views dengan parameter jenis
            echo view('Backend/template/header1');
            echo view('Backend/template/sidebarlihat', $data);
            echo view('Backend/login/lihatdoc', $data);
            echo view('Backend/template/footer');
        } else {
            return redirect()->to('/pegawai/dashboard')->with('error', 'Dokumen tidak ditemukan.');
        }
    }



public function delete($id_dokumen)
{
    $dokumenModel = new DokumenModel();
    $dokumen = $dokumenModel->find($id_dokumen);

    if ($dokumen) {
        // Hapus file dari penyimpanan
        $file_path = FCPATH . 'fileArsip/' . $dokumen['file'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        // Hapus data dari database
        $dokumenModel->delete($id_dokumen);

        // Redirect dengan pesan sukses
        session()->setFlashdata('success', 'Dokumen berhasil dihapus.');
        return redirect()->to(site_url('pegawai/dashboard'));
    } else {
        // Redirect dengan pesan error jika dokumen tidak ditemukan
        session()->setFlashdata('error', 'Dokumen tidak ditemukan.');
        return redirect()->to(site_url('pegawai/dashboard'));
    }
}

//=========================================================================
protected $userModel;

public function __construct()
{
    $this->userModel = new UserModel(); // Pastikan model UserModel ada di folder Models
}

public function profile()
{
    $session = session();
    $id_user = $session->get('user_id'); // Ubah dari 'id_user' menjadi 'user_id'

    // Cek apakah ID pengguna ada dalam sesi
    if (!$id_user) {
        return redirect()->to('login'); // Atau halaman lain yang sesuai jika sesi tidak ada
    }

    $loggedInUser = [
        'username' => $session->get('username'),
        'nama' => $session->get('nama'),
        'nip' => $session->get('nip'),
        'akses' => $session->get('akses'),
        'foto' => $session->get('foto') ?: 'profile.png'
    ];

    // Ambil data pengguna yang sesuai dengan ID pengguna yang sedang login
    $user = $this->userModel->find($id_user);

    // Kirim data pengguna yang login dan data pengguna yang sesuai ke view
    $data = [
        'loggedInUser' => $loggedInUser,
        'userdata' => [$user] // Menampilkan hanya data pengguna yang sedang login
    ];

    // Memanggil metode dataDokumen() untuk menginisialisasi data dokumen
    $data1 = $this->dataDokumen();
    
    echo view('Backend/template/headerpegawai');
    echo view('Backend/template/sidebar', $data1);
    echo view('Backend/login/profilepegawai', $data);
    echo view('Backend/template/footer');
}


public function updateProfileImage()
{
    $userModel = new UserModel();

    // Logging metode permintaan
    log_message('info', 'Request method: ' . $this->request->getMethod());

    // Ambil ID pengguna dari sesi
    $session = session();
    $id_user = $session->get('user_id');

    // Cek apakah ID pengguna ada dalam sesi
    if (!$id_user) {
        return redirect()->to('pegawai/profile')->with('error', 'ID pengguna tidak ditemukan dalam sesi.');
    }
    // Validasi input
    if (!$this->validate([
        'profile_image' => 'uploaded[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]|max_size[profile_image,2048]',
    ])) {
        log_message('error', 'Validation failed: ' . implode(', ', $this->validator->getErrors()));
        return redirect()->to('pegawai/profile')->withInput()->with('error', 'Validasi gagal atau file tidak valid.');
    }

    $file = $this->request->getFile('profile_image');
    $existingUser = $userModel->find($id_user);
    $fileName = $existingUser['foto']; // Default to existing file

    if ($file->isValid() && !$file->hasMoved()) {
        // Hapus file lama jika ada
        if (!empty($existingUser['foto']) && file_exists(ROOTPATH . 'public/admin/assets/img/' . $existingUser['foto'])) {
            unlink(ROOTPATH . 'public/admin/assets/img/' . $existingUser['foto']);
        }
        
        // Simpan file baru
        $fileName = $file->getName(); // Menggunakan nama asli file
        $file->move(ROOTPATH . 'public/admin/assets/img', $fileName);
    }
    // Update data pengguna
    $userData = [
        'foto' => $fileName
    ];

    if ($userModel->update($id_user, $userData)) {
        $session->set('foto', $fileName);
        return redirect()->to('pegawai/profile')->with('success', 'Foto profil berhasil diperbarui.');
    } else {
        return redirect()->to('pegawai/profile')->with('error', 'Gagal memperbarui foto profil.');
    }
}
//-----------------------------------------------------------------------------------------------------
// public function tambahuser()
// {
//     // Mendapatkan data akses dari database atau definisi manual
//     $data['akses'] = ['admin', 'user']; // Sesuaikan dengan enum pada database Anda

//     // Mendapatkan data user dari session
//     $session = session();
//     $data['loggedInUser'] = [
//         'username' => $session->get('username'),
//         'nama' => $session->get('nama'),
//         'foto' => $session->get('foto'),
//         'nip' => $session->get('nip'),
//         'akses' => $session->get('akses')
//     ];

//     echo view('Backend/template/sidebarprofile', $data);
//     echo view('Backend/template/headerprofile');
//     echo view('Backend/login/tambahuser', $data);
//     echo view('Backend/template/footer');
// }

// public function simpanuser()
// {
//     // Validasi input
//     $validation = \Config\Services::validation();
//     $validation->setRules([
//         'username' => 'required',
//         'nama' => 'required',
//         'password' => 'required',
//         'verifikasi_password' => 'required|matches[password]',
//         'nip' => 'required|numeric',
//         'akses' => 'required'
//     ]);

//     if (!$validation->withRequest($this->request)->run()) {
//         return redirect()->back()->withInput()->with('errors', $validation->getErrors());
//     }

//     // Menyimpan data
//     $userModel = new UserModel();
//     $data = [
//         'username' => $this->request->getPost('username'),
//         'nama' => $this->request->getPost('nama'),
//         'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
//         'nip' => $this->request->getPost('nip'),
//         'akses' => $this->request->getPost('akses')
//     ];
//     if ($userModel->insert($data)) {
//         return redirect()->to('/admin/tambahuser')->with('success', 'User berhasil ditambahkan');
//     } else {
//         return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user');
//     }
// }

public function ubahdatadiri()
{
    // Mendapatkan data user dari session
    $session = session();
    $data['loggedInUser'] = [
        'username' => $session->get('username'),
        'nama' => $session->get('nama'),
        'foto' => $session->get('foto')?: 'profile.png',
        'nip' => $session->get('nip'),
        'akses' => $session->get('akses')
    ];

    echo view('Backend/template/sidebarprofile', $data);
    echo view('Backend/template/headerprofile');
    echo view('Backend/login/ubahdatadiri', $data);
    echo view('Backend/template/footer');
}

public function simpanubahdatadiri()
{
    // Validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'username' => 'required',
        'nama' => 'required|alpha',
        'password' => 'permit_empty|min_length[6]',
        'verifikasi_password' => 'permit_empty|matches[password]',
        'nip' => 'required|numeric'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Menyimpan data
    $userModel = new UserModel();
    $data = [
        'username' => $this->request->getPost('username'),
        'nama' => $this->request->getPost('nama'),
        'nip' => $this->request->getPost('nip')
    ];

    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $userId = session()->get('user_id'); // Pastikan user_id tersimpan di session saat login
    if ($userModel->update($userId, $data)) {
        return redirect()->to('/pegawai/profile')->with('success', 'Data berhasil diperbarui');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data');
    }
}

// public function edituser($id)
// {
//     // Mendapatkan data user berdasarkan ID
//     $userModel = new UserModel();
//     $user = $userModel->find($id);
    
//     if ($user) {
//         $data['user'] = $user;
//         $data['akses'] = ['admin', 'user']; // Sesuaikan dengan enum pada database Anda
        
//       //  echo view('Backend/template/sidebarprofile', $data);
//         echo view('Backend/template/headerprofile');
//         echo view('Backend/login/edituser', $data);
//         echo view('Backend/template/footer');
//     } else {
//         return redirect()->to('/admin/profile')->with('error', 'User tidak ditemukan');
//     }
// }

// public function updateuser($id)
// {
//     // Validasi input
//     $validation = \Config\Services::validation();
//     $validation->setRules([
//         'username' => 'required',
//         'nama' => 'required',
//         'nip' => 'required|numeric',
//         'akses' => 'required',
//         'password' => 'permit_empty',
//         'verifikasi_password' => 'matches[password]'
//     ]);

//     if (!$validation->withRequest($this->request)->run()) {
//         return redirect()->back()->withInput()->with('errors', $validation->getErrors());
//     }

//     // Menyimpan data
//     $userModel = new UserModel();
//     $data = [
//         'username' => $this->request->getPost('username'),
//         'nama' => $this->request->getPost('nama'),
//         'nip' => $this->request->getPost('nip'),
//         'akses' => $this->request->getPost('akses')
//     ];

//     // Jika password diisi, tambahkan ke data
//     $password = $this->request->getPost('password');
//     if (!empty($password)) {
//         $data['password'] = password_hash($password, PASSWORD_DEFAULT);
//     }

//     if ($userModel->update($id, $data)) {
//         return redirect()->to('/admin/profile')->with('success', 'User berhasil diupdate');
//     } else {
//         return redirect()->back()->withInput()->with('error', 'Gagal mengupdate user');
//     }
// }


// public function deleteuser($id)
// {
//     $userModel = new UserModel();
    
//     if ($userModel->delete($id)) {
//         return redirect()->to('/admin/profile')->with('success', 'User berhasil dihapus');
//     } else {
//         return redirect()->back()->with('error', 'Gagal menghapus user');
//     }
// }



}
