<!-- ------------------------------ -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Menampilkan jenis dokumen yang dipilih di header -->
            <h1 class="mt-4">
                <?= isset($jenisDipilih) && $jenisDipilih !== 'All' ? 'Dokumen: ' . $jenisDipilih : 'Dashboard'; ?>
            </h1>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a
                        href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard')); ?>">Dashboard</a>
                </li>
                <!-- Menampilkan jenis dokumen yang dipilih di breadcrumb -->
                <li class="breadcrumb-item active">Jenis
                    Dokumen<?= isset($jenisDipilih) ? ': ' . $jenisDipilih : ': All'; ?></li>
            </ol>


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
                table td:nth-child(6) {
                    word-wrap: break-word;
                    word-break: break-all;
                    overflow-wrap: break-word;
                    white-space: normal;
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
                <?php if (session()->get('akses') == 'admin'): ?>
                    <a href="<?= site_url('admin/tambahdoc'); ?>" class="btn btn-primary btn-right">Tambah Dokumen +</a>
                <?php elseif (session()->get('akses') == 'user'): ?>
                    <a href="<?= site_url('pegawai/tambahdoc'); ?>" class="btn btn-primary btn-right">Tambah Dokumen +</a>
                <?php endif; ?>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Dokumen
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th data-sortable="false">Judul Dokumen
                                        <input class="form-control mr-sm-2" type="text" autocomplete="off"
                                            placeholder="Cari" aria-label="Search" id="Judul">
                                    </th>
                                    <th data-sortable="false">Tahun
                                        <!-- <select class="custom-select" id="Tahun">
                                            <option value="">Pilih Tahun</option>
                                            <?php for ($year = date("Y"); $year >= 1990; $year--) { ?>
                                                <option value="<?= $year ?>"><?= $year ?></option>
                                            <?php } ?>
                                        </select> -->
                                        <select class="custom-select" id="Tahun">
                                            <option value="">Pilih Tahun</option>
                                            <?php foreach ($tahun as $row): ?>
                                                <option value="<?= $row['tahun'] ?>" <?= ($tahunDipilih == $row['tahun']) ? 'selected' : '' ?>>
                                                    <?= $row['tahun'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                    <th data-sortable="false">Jenis Dokumen</th>
                                    <th data-sortable="false">Kategori
                                        <select class="custom-select" id="Kategori">
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $row): ?>
                                                <option value="<?= $row['nama_kategori'] ?>"><?= $row['nama_kategori'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                    <th data-sortable="false">Filename
                                        <input class="form-control mr-sm-2" type="text" autocomplete="off"
                                            placeholder="Cari" aria-label="Search" id="File">
                                    </th>
                                    <th data-sortable="false">Keterangan</th>
                                    <th data-sortable="false">Aksi</th>
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
                                        <td id="keterangan"><?= $row['keterangan']; ?></td>


                                        <td>
                                            <div class="mt-4">
                                                <?php if (session()->get('akses') == 'admin'): ?>
                                                    <a href="<?= site_url('admin/lihatdoc/' . $row['id_dokumen'] . '?jenis=' . urlencode($jenisDipilih)); ?>"
                                                        class="btn btn-primary">Detail/Lihat</a>
                                                <?php elseif (session()->get('akses') == 'user'): ?>
                                                    <a href="<?= site_url('pegawai/lihatdoc/' . $row['id_dokumen'] . '?jenis=' . urlencode($jenisDipilih)); ?>"
                                                        class="btn btn-primary">Detail/Lihat</a>
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

            inputJudul.addEventListener("input", filterTable);
            inputTahun.addEventListener("change", updateFilters);
            inputKategori.addEventListener("change", updateFilters);
            inputFile.addEventListener("input", filterTable);

            function updateFilters() {
                filterTable();
                updateOptions();
            }

            function filterTable() {
                var filterJudul = inputJudul.value.toUpperCase();
                var filterTahun = inputTahun.value;
                var filterKategori = inputKategori.value.toUpperCase();
                var filterFile = inputFile.value.toUpperCase();

                var tables = document.querySelectorAll("table");
                tables.forEach(function (table) {
                    var tbody = table.querySelector("tbody");
                    if (!tbody) return;
                    var rows = tbody.getElementsByTagName("tr");

                    for (var i = 0; i < rows.length; i++) {
                        var row = rows[i];
                        var judul = row.cells[0].textContent.toUpperCase();
                        var tahun = row.cells[1].textContent;
                        var kategori = row.cells[3].textContent.toUpperCase();
                        var file = row.cells[4].textContent.toUpperCase();

                        var matches =
                            (judul.indexOf(filterJudul) > -1 || filterJudul === '') &&
                            (tahun == filterTahun || filterTahun === '') &&
                            (kategori.indexOf(filterKategori) > -1 || filterKategori === '') &&
                            (file.indexOf(filterFile) > -1 || filterFile === '');

                        row.style.display = matches ? "" : "none";
                    }
                });
            }

            function updateOptions() {
                var currentTahun = inputTahun.value;
                var currentKategori = inputKategori.value.toUpperCase();

                var tables = document.querySelectorAll("table");
                tables.forEach(function (table) {
                    var tbody = table.querySelector("tbody");
                    if (!tbody) return;
                    var rows = tbody.getElementsByTagName("tr");

                    var tahunOptions = new Set();
                    var kategoriOptions = new Set();

                    for (var i = 0; i < rows.length; i++) {
                        var row = rows[i];
                        var tahun = row.cells[1].textContent;
                        var kategori = row.cells[3].textContent.toUpperCase();

                        if (row.style.display !== "none") {
                            tahunOptions.add(tahun);
                            kategoriOptions.add(kategori);
                        }
                    }

                    updateSelectOptions(inputTahun, tahunOptions);
                    updateSelectOptions(inputKategori, kategoriOptions);
                });
            }

            function updateSelectOptions(selectElement, optionsSet) {
                var currentValue = selectElement.value;
                var options = selectElement.querySelectorAll("option");
                options.forEach(function (option) {
                    if (option.value && option.value !== "") {
                        option.style.display = optionsSet.has(option.value) ? "" : "none";
                    }
                });

                if (!optionsSet.has(currentValue)) {
                    selectElement.value = "";
                }
            }
        });

    </script>