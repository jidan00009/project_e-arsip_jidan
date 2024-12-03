  <div class="container mt-5">
        <div class="row">
            <div class="col">
                <table rules="all" border="2" cellpadding="10" cellspacing="0" class="table bg-white table-bordered table-hover table-primary shadow-box">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku
                                <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Cari" aria-label="Search" id="Judul">
                            </th>
                            <th>
                                Tahun
                                <select class="custom-select" id="Tahun">
                                <?php for ($year = date("Y"); $year >= 1990; $year--) { ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                            <th>
                                Kategori
                                <select class="custom-select" id="Kategori">
                                    <?php foreach ($kategori as $row) : ?>
                                        <option value="<?= $row['nama_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                            <th>File
                                <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Cari" aria-label="Search" id="File">
                            </th>
                            <th class="aksi">Aksi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php $i = 1; ?>
                        <?php foreach ($isi as $row) :
                            $file_path = "uploads/" . $row['filename']; ?>
                            <tr class="text-center">
                                <td><?= $i; ?></td>
                                <td style="text-align: left;"><?= $row["judul_buku"]; ?></td>
                                <td style="text-align: left;"><?= $row["tahun"]; ?></td>
                                <td style="text-align: left;"><?= $row["nama_kategori"]; ?></td>
                                <td style="text-align: left;"><?= $row["filename"]; ?></td>
                                <td class="aksi">
                                    <div class="dropdown text-center">
                                        <button class="btn btn-warning text-white dropdown-toggle" type="button" id="dropdownMenuButton<?= $i ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $i ?>">
                                            <a class="dropdown-item" href="<?= $file_path; ?>" target="_blank">Lihat</a>
                                            <a class="dropdown-item" href="<?= $file_path; ?>" download>Download</a>
                                            <a class="dropdown-item" href="<?= $file_path; ?>" target="_blank">Cetak</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?= $i; ?>">
                                        Riwayat
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Riwayat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= $row['keterangan']; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <<script>
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
                var judul = row.cells[1].textContent.toUpperCase();
                return judul.indexOf(filter) > -1;
            });
        }

        function filterTahun() {
            var filter = inputTahun.value;
            filterTable(function (row) {
                var tahun = row.cells[2].textContent;
                return tahun == filter || filter == '';
            });
        }

        function filterKategori() {
            var filter = inputKategori.value.toUpperCase();
            filterTable(function (row) {
                var kategori = row.cells[3].textContent.toUpperCase();
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
            var tbody = document.getElementById("myTable");
            var rows = tbody.getElementsByTagName("tr");

            for (var i = 0; i < rows.length; i++) {
                if (filterFunction(rows[i])) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });
</script>
