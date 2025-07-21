<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Input Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form-container {
            background-color: #2c7075;
            padding: 25px;
            border-radius: 15px;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-control,
        .btn {
            border-radius: 15px;
        }

        .table-wrapper {
            max-width: 1000px;
            margin: 40px auto;
        }

        .btn-toggle {
            background-color: #b7ede7;
            color: #000;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .custom-thead {
            background-color: #2c7075 !important;
        }

        .custom-table th,
        .custom-table td {
            font-size: 0.85rem;
            padding: 6px 8px;
            white-space: nowrap;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            .form-container,
            .table-wrapper {
                padding: 10px;
            }
        }

        .custom-btn {
            background-color: #2C6A74;
            color: white;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .custom-btn:hover {
            background-color: #1f4f55;
            transform: scale(1.05);
        }

        tr.group th {
            color: white !important;
        }

        .td-aksi {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
            padding-top: 5px;
        }

        .group {
            color: white;
        }

        .table td {
            vertical-align: middle !important;
        }

        .card-header {
            background-color: #b7ede7;
            font-weight: 600;
            cursor: pointer;
            border-radius: 15px 15px 0 0;
        }

        .card {
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h4 class="text-center mb-3 h4 fw-bold">Form Input Data Siswa</h4>

        <div class="form-container mt-3 mx-auto" style="max-width: 100%;">
                <form id="formSiswa">
            <input type="hidden" name="id">

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="group">NISN</label>
                        <input type="text" class="form-control" name="nisn" required>
                    </div>
                    <div class="form-group">
                        <label class="group">NIPD</label>
                        <input type="text" class="form-control" name="nipd" required>
                    </div>
                    <div class="form-group">
                        <label class="group">Nama</label>
                        <input type="text" class="form-control" name="nama" oninput="this.value = this.value.toUpperCase();" required>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="group">Kelas</label>
                        <input type="text" class="form-control" name="kelas" oninput="this.value = this.value.toUpperCase();" required>
                    </div>
                    <div class="form-group">
                        <label class="group">Jenis Kelamin</label>
                        <select name="jk" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="group">Wali Kelas</label>
                        <input type="text" class="form-control" name="wali_kelas" required>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-toggle px-4">Simpan</button>
            </div>
        </form>
        </div>

        <!-- Toast Sukses -->
<div aria-live="polite" aria-atomic="true"
    style="position: fixed; top: 20px; right: 20px; z-index: 1080; min-width: 300px;">
    <div id="toastSukses" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check-circle mr-2"></i>
            <strong class="mr-auto">Berhasil</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Data siswa berhasil disimpan!
        </div>
    </div>
</div>


    <div class="table-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-group mb-0">
                <label for="filterKelas">Filter Kelas</label>
                <select id="filterKelas" class="form-control" onchange="filterByKelas()">
                    <option value="">-- Semua Kelas --</option>
                    <optgroup label="RPL">
                            <option value="X RPL A">X RPL A</option>
                            <option value="X RPL B">X RPL B</option>
                            <option value="X RPL C">X RPL C</option>
                            <option value="X RPL D">X RPL D</option>
                            <option value="XI RPL A">XI RPL A</option>
                            <option value="XI RPL B">XI RPL B</option>
                            <option value="XI RPL C">XI RPL C</option>
                            <option value="XI RPL D">XI RPL D</option>
                            <option value="XII RPL A">XII RPL A</option>
                            <option value="XII RPL B">XII RPL B</option>
                            <option value="XII RPL C">XII RPL C</option>
                            <option value="XII RPL D">XII RPL D</option>
                        </optgroup>
                        <optgroup label="TKJ">
                            <option value="X TKJ A">X TKJ A</option>
                            <option value="X TKJ B">X TKJ B</option>
                            <option value="X TKJ C">X TKJ C</option>
                            <option value="X TKJ D">X TKJ D</option>
                            <option value="XI TKJ A">XI TKJ A</option>
                            <option value="XI TKJ B">XI TKJ B</option>
                            <option value="XI TKJ C">XI TKJ C</option>
                            <option value="XI TKJ D">XI TKJ D</option>
                            <option value="XII TKJ A">XII TKJ A</option>
                            <option value="XII TKJ B">XII TKJ B</option>
                            <option value="XII TKJ C">XII TKJ C</option>
                            <option value="XII TKJ D">XII TKJ D</option>
                        </optgroup>
                        <optgroup label="METRO">
                            <option value="X METRO A">X METRO A</option>
                            <option value="X METRO B">X METRO B</option>
                            <option value="XI METRO A">XI METRO A</option>
                            <option value="XI METRO B">XI METRO B</option>
                            <option value="XII METRO A">XII METRO A</option>
                            <option value="XII METRO B">XII METRO B</option>
                        </optgroup>
                        <optgroup label="ELIN">
                            <option value="X ELIN A">X ELIN A</option>
                            <option value="X ELIN B">X ELIN B</option>
                            <option value="XI ELIN A">XI ELIN A</option>
                            <option value="XI ELIN B">XI ELIN B</option>
                            <option value="XII ELIN A">XII ELIN A</option>
                            <option value="XII ELIN B">XII ELIN B</option>
                        </optgroup>
                </select>
            </div>

            <div class="form-group mb-0">
                <label for="searchNama"></label>
                <input type="text" class="form-control" id="searchNama" onkeyup="searchNama()" placeholder="Cari nama siswa...">
            </div>
        </div>

        <div class="table-responsive">
        <table class="table custom-table mb-0">
            <thead class="custom-thead text-white">
                <tr class="group">
                    <th>NO.</th>
                    <th>NISN</th>
                    <th>NIPD</th>
                    <th>NAMA</th>
                    <th>KELAS</th>
                    <th>JENIS KELAMIN</th>
                    <th>WALI KELAS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody id="tabelSiswa"></tbody>
        </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            ambilData();
        });

        function ambilData() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/data_siswa/ambildata") ?>',
                dataType: 'json',
                success: function (res) {
                    const semuaData = [...res.kelas_x, ...res.kelas_xi, ...res.kelas_xii];
                    renderTable(semuaData, '#tabelSiswa');
                }
            });
        }

        function renderTable(data, targetId) {
            let baris = '';
            for (let i = 0; i < data.length; i++) {
                baris += `
                    <tr id="baris-${data[i].id}">
                        <td>${i + 1}</td>
                        <td>${data[i].nisn}</td>
                        <td>${data[i].nipd}</td>
                        <td>${data[i].nama}</td>
                        <td>${data[i].kelas}</td>
                        <td>${data[i].jk}</td>
                        <td>${data[i].wali_kelas}</td>
                        <td class="td-aksi">
                            <button class="btn custom-btn btn-sm" onclick="submit(${data[i].id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="hapus(${data[i].id})">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </td>

                    </tr>`;
            }
            $(targetId).html(baris);
        }

        $('#formSiswa').submit(function (e) {
            e.preventDefault();

            var id = $("[name='id']").val();
            var formData = {
                id: id,
                nisn: $("[name='nisn']").val(),
                nipd: $("[name='nipd']").val(),
                nama: $("[name='nama']").val(),
                kelas: $("[name='kelas']").val(),
                jk: $("[name='jk']").val(),
                wali_kelas: $("[name='wali_kelas']").val()
            };

            var url = id === "" ? '<?php echo base_url("index.php/data_siswa/tambahdata") ?>' : '<?php echo base_url("index.php/data_siswa/ubahdata") ?>';

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                success: function (res) {
                    if (res.pesan === '') {
                        $('#formSiswa')[0].reset();
                        ambilData();

                        // Inisialisasi & tampilkan toast selama 3 detik
                        $('#toastSukses').toast({ delay: 3000 });
                        $('#toastSukses').toast('show');
                    } else {
                        alert(res.pesan);
                    }
                }
            });
        });

        function submit(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/data_siswa/ambilId") ?>',
                data: { id: id },
                dataType: 'json',
                success: function (hasil) {
                    if (hasil.length > 0) {
                        $("[name='id']").val(hasil[0].id);
                        $("[name='nisn']").val(hasil[0].nisn);
                        $("[name='nipd']").val(hasil[0].nipd);
                        $("[name='nama']").val(hasil[0].nama);
                        $("[name='kelas']").val(hasil[0].kelas);
                        $("[name='jk']").val(hasil[0].jk);
                        $("[name='wali_kelas']").val(hasil[0].wali_kelas);
                   
                        $('html, body').animate({
                            scrollTop: $(".form-container").offset().top - 600
                        }, 600);
                    } else {
                        alert("Data tidak ditemukan.");
                    }
                }
            });
        }

        function hapus(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data siswa ini?")) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("index.php/data_siswa/hapusdata") ?>',
            data: { id: id },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    ambilData();
                } else {
                    alert("Gagal menghapus data!");
                }
            }
        });
    }
}


        function filterByKelas() {
            const kelas = $('#filterKelas').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/data_siswa/filterByKelas") ?>',
                data: { kelas: kelas },
                dataType: 'json',
                success: function (data) {
                    renderTable(data, '#tabelSiswa');
                }
            });
        }

        function searchNama() {
            const keyword = $('#searchNama').val().toLowerCase();
            $('#tabelSiswa tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>