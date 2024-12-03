<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Jenis Dokumen</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Jenis Dokumen</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
    <tr>
        <th data-sortable ="false" class = "juduldoc" >Judul Dokumen
            <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Cari" aria-label="Search" id="Judul">
        </th>
        <th>Tahun
            <select class="custom-select" id="Tahun">
                <?php for ($year = date("Y"); $year >= 1990; $year--) { ?>
                    <option value="<?= $year ?>"><?= $year ?></option>
                <?php } ?>
            </select>
        </th>
        <th>Jenis Dokumen</th>
        <th>Kategori
            <select class="custom-select" id="Kategori">
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
                                    <tfoot>
                                        <tr>
                                            <th>Judul Dokumen</th>
                                            <th>Tahun</th>
                                            <th>Jenis Dokumen</th>
                                            <th>Kategori</th>
                                            <th>Filename</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    
<?php foreach ($filteredData as $row): ?>
        <tr>
            <td><?= $row['judul_buku']; ?></td>
            <td><?= $row['tahun']; ?></td>
            <!-- Menampilkan kolom jenis dokumen -->
            <td><?= $row['jenis']; ?></td>
            <td><?= $row['nama_kategori']; ?></td>
            <td><?= $row['filename']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $row['id_arsip_dokumen']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                    Aksi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $row['id_arsip_dokumen']; ?>">
                    <li><a class="dropdown-item" href="#">Lihat</a></li>
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Hapus</a></li>
                    <li><a class="dropdown-item" href="#">Download</a></li>
                    <li><a class="dropdown-item" href="#">Cetak</a></li>
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
                                    
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
    <!-- ------------------------------ -->

    <script>
   document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen input pencarian
    var inputJudul = document.getElementById("Judul");
    var inputTahun = document.getElementById("Tahun");
    var inputKategori = document.getElementById("Kategori");
    var inputFile = document.getElementById("File");

    // Tambahkan event listener untuk setiap elemen input pencarian
    inputJudul.addEventListener("input", filterJudul);
    inputTahun.addEventListener("change", filterTahun);
    inputKategori.addEventListener("change", filterKategori);
    inputFile.addEventListener("input", filterFile);

    function filterJudul() {
        var filter = inputJudul.value.toUpperCase();
        filterTable(function (row) {
            var judul = row.cells[0].textContent.toUpperCase(); // Index 0 karena judul berada pada kolom pertama
            return judul.indexOf(filter) > -1;
        });
    }

    function filterTahun() {
        var filter = inputTahun.value;
        filterTable(function (row) {
            var tahun = row.cells[1].textContent; // Index 1 karena tahun berada pada kolom kedua
            return tahun == filter || filter == '';
        });
    }

    function filterKategori() {
        var filter = inputKategori.value.toUpperCase();
        filterTable(function (row) {
            var kategori = row.cells[2].textContent.toUpperCase(); // Index 2 karena kategori berada pada kolom ketiga
            return kategori.indexOf(filter) > -1;
        });
    }

    function filterFile() {
        var filter = inputFile.value.toUpperCase();
        filterTable(function (row) {
            var file = row.cells[3].textContent.toUpperCase(); // Index 3 karena nama file berada pada kolom keempat
            return file.indexOf(filter) > -1;
        });
    }

    function filterTable(filterFunction) {
        var tables = document.querySelectorAll("table"); // Mengambil semua elemen tabel dalam dokumen
        tables.forEach(function(table) {
            var tbody = table.querySelector("tbody"); // Ambil elemen tbody di dalam setiap tabel
            if (!tbody) return; // Jika tidak ada tbody, lanjutkan ke tabel berikutnya
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
