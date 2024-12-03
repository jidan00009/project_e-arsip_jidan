<style>
    .row {
        padding: 0.75rem;



    }

    .keterangan {
        word-wrap: break-word;
        word-break: break-all;
        overflow-wrap: break-word;
        white-space: normal;
        /* Ensure text wraps to next line */
    }
</style>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <a class="nav-link" href="<?= site_url('admin/dashboard'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Detail Dokumen</div>
                    <div class="row">

                        <p><strong>Judul Dokumen:</strong> <?= $dokumen['nama_dokumen']; ?></p>
                        <p><strong>Nama Pengunggah/Pengedit:</strong> <?= esc($nama_user); ?></p>
                        <p><strong>Filename:</strong> <?= $dokumen['file']; ?></p>
                        <!-- <p><strong>Filesize:</strong> <?= $dokumen['filesize']; ?> bytes</p> -->
                        <?php
                        // Konversi filesize dari bytes ke megabytes
                        $filesize_in_mb = $dokumen['filesize'] / 1048576;
                        ?>

                        <p><strong>Filesize:</strong> <?= number_format($filesize_in_mb, 2); ?> MB</p>


                        <p><strong>Tahun:</strong> <?= $dokumen['tahun']; ?></p>
                        <p><strong>Waktu Upload:</strong> <?= $dokumen['waktu_upload']; ?></p>
                        <p><strong>Waktu Update:</strong> <?= $dokumen['waktu_update']; ?></p>

                        <p><strong>Jenis Dokumen:</strong> <?= $nama_jenis; ?></p>
                        <p><strong>Kategori:</strong> <?= $nama_kategori; ?></p>

                        <p class="keterangan"><strong>Keterangan:</strong> <?= $dokumen['keterangan']; ?></p>

                    </div>
                </div>

                <!-- -------- -->


            </div>
            <div class="sb-sidenav-footer">
                <div class="small"></div>

            </div>
        </nav>
    </div>