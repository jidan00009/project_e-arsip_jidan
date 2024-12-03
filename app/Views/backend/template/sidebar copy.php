<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-arsip</title>
<!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link"
                        href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard')); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    </a>
                    <!-- <a class="nav-link" href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/tambahkategori' : 'pegawai/tambahkategori')); ?>">
    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
    Tambah Kategori Dokumen
</a> -->



                    <!-- Dropdown for Jenis Dokumen -->
                    <div class="sb-sidenav-menu-heading">Jenis Dokumen</div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="jenisDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-folder-open"></i> Pilih Jenis Dokumen
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="jenisDropdown">
                            <?php foreach ($jenis as $nama_jenis): ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard') . '?jenis=' . urlencode($nama_jenis)); ?>">
                                        <?= $nama_jenis; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <!-- End Dropdown for Jenis Dokumen -->

                    <!-- Link to Add Jenis Dokumen -->
                    <!-- <a class="nav-link" href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/tambahjenis' : 'pegawai/tambahjenis')); ?>">
    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
    Tambah Jenis Dokumen
</a> -->
                    <!-- -------- -->

                </div>
                <div class="sb-sidenav-menu-heading">Kategori Dokumen</div>
                <a class="nav-link"
                    href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/tambahkategori' : 'pegawai/tambahkategori')); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                    Tambah Kategori Dokumen
                </a>

            </div>

            <div class="sb-sidenav-footer">

            </div>
        </nav>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>