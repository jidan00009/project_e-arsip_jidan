<?php
// Periksa keberadaan file di storage sebelum menampilkan
$file_path = FCPATH . 'fileArsip/' . $dokumen['file'];
$file_exists = file_exists($file_path);
$jenisDipilih = isset($_GET['jenis']) ? $_GET['jenis'] : 'All';

// Menentukan URL tombol Kembali
$kembaliUrl = session()->getFlashdata('edit_active')
    ? site_url('admin/dashboard')
    : site_url('admin/dashboard' . ($jenisDipilih ? '?jenis=' . urlencode($jenisDipilih) : ''));
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> </h1>
            <h1 class="mt-4">Lihat Dokumen</h1>



            
            <!-- Notifikasi berhasil -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Notifikasi error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Lihat Dokumen</li>
            </ol>
            <!-- Tombol untuk kembali, cetak, download, hapus, dan edit -->
            <div class="mt-4">
                <a href="<?= $kembaliUrl; ?>" class="btn btn-primary">Kembali</a>

                <?php if ($file_exists): ?>
                    <a href="<?= base_url('fileArsip/'.$dokumen['file']); ?>" class="btn btn-success" target="_blank">Cetak</a>
                    <a href="<?= base_url('fileArsip/'.$dokumen['file']); ?>" class="btn btn-info" download>Download</a>
                <?php else: ?>
                    <button class="btn btn-success" disabled>Cetak</button>
                    <button class="btn btn-info" disabled>Download</button>
                <?php endif; ?>
                <a href="<?= site_url('admin/delete/'.$dokumen['id_dokumen']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">Hapus</a>
                <a href="<?= site_url('admin/editdoc/'.$dokumen['id_dokumen']); ?>" class="btn btn-warning">Edit</a>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt me-1"></i>
                    Dokumen: <?= $dokumen['nama_dokumen']; ?>
                </div>
                
                <div class="card-body">
                    <center>
                    <?php if ($file_exists): ?>
                        <!-- Iframe untuk menampilkan dokumen -->
                        <iframe src="<?= base_url('fileArsip/'.$dokumen['file']); ?>" height="400px" width="100%" title="Iframe Example"></iframe>
                    <?php else: ?>
                        <p><strong><span style="color: red;">File dokumen tidak ditemukan atau telah dihapus.</span></strong></p>
                    <?php endif; ?>
                    </center>
                    <div class="row">
                        <!-- Kolom pertama -->
                        <div class="col-lg-4">
                            <p><strong>Judul Dokumen:</strong> <?= $dokumen['nama_dokumen']; ?></p>
                            <p><strong>Filename:</strong> <?= $dokumen['file']; ?></p>
                            <p><strong>Filesize:</strong> <?= $dokumen['filesize']; ?> bytes</p>
                        </div>
                        <!-- Kolom kedua -->
                        <div class="col-lg-4">
                            <p><strong>Tahun:</strong> <?= $dokumen['tahun']; ?></p>
                            <p><strong>Waktu Upload:</strong> <?= $dokumen['waktu_upload']; ?></p>
                            <p><strong>Waktu Update:</strong> <?= $dokumen['waktu_update']; ?></p>
                        </div>
                        <!-- Kolom ketiga -->
                        <div class="col-lg-4">
                            <p><strong>Jenis Dokumen:</strong> <?= $nama_jenis; ?></p>
                            <p><strong>Kategori:</strong> <?= $nama_kategori; ?></p>
                            <p><strong>Keterangan:</strong> <?= $dokumen['keterangan']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

