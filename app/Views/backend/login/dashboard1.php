<!-- ------------------------------ -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Menampilkan jenis dokumen yang dipilih di header -->
            <h1 class="mt-4"><?= isset($jenisDipilih) && $jenisDipilih !== 'All' ? 'Dokumen: ' . $jenisDipilih : 'Dashboard'; ?></h1>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard')); ?>">Dashboard</a></li>
                <!-- Menampilkan jenis dokumen yang dipilih di breadcrumb -->
                <li class="breadcrumb-item active">Jenis Dokumen<?= isset($jenisDipilih) ? ': ' . $jenisDipilih : ': All'; ?></li>
            </ol>

            <div class="card mb-4">
                <div class="card-body">
                    DataTables is a third party plugin that is used to generate the demo table below. For more
                    information about DataTables, please visit the
                    <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.
                </div>
            </div>

            <!-- Notifikasi -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <style>
                .keterangan {
                    word-wrap: break-word;
                    word-break: break-all;
                    overflow-wrap: break-word;
                    white-space: normal; /* Ensure text wraps to next line */
                }

                .d-flex {
                    display: flex;
                    justify-content: space-between;
                }
                .btn-left {
                    margin-right: auto;
                }
                .btn-right {
                    margin-left: auto;
                }
            </style>

            <div class="d-flex mb-4">
                <?php if (session()->get('akses') == 'admin') : ?>
                    <a href="<?= site_url('admin/tambahdoc'); ?>" class="btn btn-secondary btn-right">Tambah Dokumen +</a>
                <?php elseif (session()->get('akses') == 'user') : ?>
                    <a href="<?= site_url('pegawai/tambahdoc'); ?>" class="btn btn-secondary btn-right">Tambah Dokumen +</a>
                <?php endif; ?>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Judul Dokumen
                                        <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Cari" aria-label="Search" id="Judul">
                                    </th>
                                    <th>Tahun
                                        <select class="custom-select" id="Tahun">
                                            <option value="">Pilih Tahun</option>
                                            <?php for ($year = date("Y"); $year >= 1990; $year--) { ?>
                                                <option value="<?= $year ?>"><?= $year ?></option>
                                            <?php } ?>
                                        </select>
                                    </th>
                                    <th>Jenis Dokumen</th>
                                    <th>Kategori
                                        <select class="custom-select" id="Kategori">
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $row) : ?>
                                                <option value="<?= $row['nama_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                    <th>Filename
                                        <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Cari" aria-label="Search" id="File">
                                    </th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($filteredData as $row): ?>
                                    <tr>
                                        <td><?= $row['nama_dokumen']; ?></td>
                                        <td><?= $row['tahun']; ?></td>
                                        <td><?= $row['jenis']; ?></td>
                                        <td><?= $row['nama_kategori']; ?></td>
                                        <td><?= $row['file']; ?></td>
                                        <td class="keterangan"><?= $row['keterangan']; ?></td>
                                        <td>
                                            <div class="mt-4">
                                                <?php if (session()->get('akses') == 'admin') : ?>
                                                    <a href="<?= site_url('admin/lihatdoc/' . $row['id_dokumen'] . '?jenis=' . urlencode($jenisDipilih)); ?>" class="btn btn-primary">Detail/Lihat</a>
                                                <?php elseif (session()->get('akses') == 'user') : ?>
                                                    <a href="<?= site_url('pegawai/lihatdoc/' . $row['id_dokumen'] . '?jenis=' . urlencode($jenisDipilih)); ?>" class="btn btn-primary">Detail/Lihat</a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ------------------------------ -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputJudul = document.getElementById("Judul");
            var inputTahun = document.getElementById("Tahun");
            var inputKategori = document.getElementById("Kategori");
            var inputFile = document.getElementById("File");

            inputJudul.addEventListener("input", filterJudul);
            inputTahun.addEventListener("change", filterTahun);
            inputKategori.addEventListener("change", filterKategori);
            inputFile.addEventListener("input", filterFile);

            function filterJudul() {
                var filter = inputJudul.value.toUpperCase();
                filterTable(function (row) {
                    var judul = row.cells[0].textContent.toUpperCase();
                    return judul.indexOf(filter) > -1;
                });
            }

            function filterTahun() {
                var filter = inputTahun.value;
                filterTable(function (row) {
                    var tahun = row.cells[1].textContent;
                    return tahun == filter || filter == '';
                });
            }

            function filterKategori() {
                var filter = inputKategori.value.toUpperCase();
                filterTable(function (row) {
                    var kategori = row.cells[3].textContent.toUpperCase(); // Perubahan disini, index 3 untuk kolom kategori
                    return kategori.indexOf(filter) > -1;
                });
            }

            function filterFile() {
                var filter = inputFile.value.toUpperCase();
                filterTable(function (row) {
                    var file = row.cells[4].textContent.toUpperCase();
                    return file.indexOf(filter) > -1;
                });
            }

            function filterTable(filterFunction) {
                var tables = document.querySelectorAll("table");
                tables.forEach(function(table) {
                    var tbody = table.querySelector("tbody");
                    if (!tbody) return;
                    var rows = tbody.getElementsByTagName("tr");

                    for (var i = 0; i < rows.length; i++) {
                        if (filterFunction(rows[i])) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                });
            }
        });
    </script>
