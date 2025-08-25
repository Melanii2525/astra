<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/material-dashboard.min.js"></script>
</head>

<style>
    .custom-btn {
        background-color: #2C6A74;
        color: white;
        margin-top: 20px;
        border-radius: 50px;
    }

    .custom-btn:hover {
        background-color: #24565d;
        color: white;
    }

    .tab-kategori {
        background-color: #aee3e0;
        color: #2c6a74;
        margin-right: 10px;
        font-weight: 500;
        transition: 0.3s;
        border-radius: 8px;
    }

    .tab-kategori:hover {
        background-color: #5da9b0;
        color: white;
    }

    .custom-thead,
    thead.table-light {
        background-color: #AEE3E0 !important;
    }

    .custom-table {
        border-radius: 20px;
        overflow: hidden;
    }

    table.table-bordered th,
    table.table-bordered td {
        border: 1px solid #2C6A74 !important;
        vertical-align: middle;
        font-weight: 500;
    }

    table.table-bordered th {
        background-color: #2C6A74 !important;
        color: white;
    }

    table.table-bordered td {
        background-color: #f9fdfd;
    }

    .modal-content {
        background-color: #2C6A74;
        border-radius: 20px;
        padding: 20px;
        color: white;
    }

    .modal-header {
        border-bottom: 1px solid #AEE3E0;
        justify-content: center;
    }

    .modal-header h1 {
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    .form-label {
        color: #6c757d;
        font-size: 15px;
        margin-bottom: 50px;
    }

    .form-control {
        border-radius: 20px;
        background-color: #d3d3d3;
        border: none;
    }

    .btn-custom-submit {
        background-color: #AEE3E0;
        color: black;
        border-radius: 25px;
        padding: 8px 25px;
        border: none;
    }

    .btn-custom-submit:hover {
        background-color: #92c8c4;
        color: white;
    }

    .table td {
        vertical-align: middle !important;
    }

    .table thead th {
        vertical-align: middle !important;
        text-align: center;
        font-size: 14px;
        padding: 12px;
    }

    .table td {
        font-size: 14px;
        padding: 10px;
        vertical-align: middle !important;
        text-align: center;
    }

    .group {
        color: white;
    }

    .td-aksi a.btn {
        font-size: 13px;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .td-aksi i {
        margin-right: 5px;
    }

    #form-kehadiran {
        display: none;
        position: fixed;
        z-index: 1050;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow-y: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    #form-kehadiran .card {
        width: 90%;
        max-width: 500px;
        margin: 50px auto;
        background-color: #2C6A74;
        color: white;
        border-radius: 20px;
        padding: 20px;
    }

    .card.h-100.w-100 {
        margin-top: 10px;
    }

    .btn-custom-detail {
        background-color: #2C6A74;
        color: white;
        border: none;
    }

    .btn-custom-detail:hover {
        background-color: #24565d;
        color: #fff;
    }

    .modern-modal {
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(44, 106, 116, 0.3);
        border: none;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Header */
    .modern-modal .modal-header {
        background: linear-gradient(135deg, #2c6a74, #5da9b0);
        color: #d0efef;
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        font-size: 1.25rem;
        align-items: center;
    }

    /* Close button style */
    .modern-modal .modal-header .close {
        color: #d0efef;
        opacity: 0.85;
        font-size: 1.5rem;
        font-weight: 700;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;
    }

    .modern-modal .modal-header .close:hover {
        opacity: 1;
    }

    /* Body */
    .modern-modal .modal-body {
        padding: 1.5rem;
        background-color: #d0efef;
        color: #2c6a74;
    }

    /* Label */
    .modern-modal .label-input {
        display: block;
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: #2c6a74;
    }

    /* Input */
    .modern-modal .form-control {
        width: 100%;
        padding: 0.6rem 1rem;
        border-radius: 12px;
        border: 2px solid #5da9b0;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        box-shadow: none;
        color: #2c6a74;
        background-color: #aee3e0;
    }

    .modern-modal .form-control::placeholder {
        color: #2c6a74aa;
    }

    .modern-modal .form-control:focus {
        border-color: #2c6a74;
        outline: none;
        box-shadow: 0 0 8px rgba(44, 106, 116, 0.4);
        background-color: #d0efef;
    }

    /* Footer */
    .modern-modal .modal-footer {
        background-color: #aee3e0;
        border-top: none;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.8rem;
    }

    /* Buttons */
    .modern-modal .btn {
        border-radius: 12px;
        padding: 0.5rem 1.4rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border: none;
        color: #fff;
    }

    /* Cancel button */
    .modern-modal .btn-cancel {
        background-color: #5da9b0;
        color: #d0efef;
    }

    .modern-modal .btn-cancel:hover {
        background-color: #2c6a74;
        color: #aee3e0;
    }

    /* Export PDF button */
    .modern-modal .btn-export {
        background: linear-gradient(135deg, #2c6a74, #5da9b0);
        box-shadow: 0 4px 12px rgba(44, 106, 116, 0.4);
    }

    .modern-modal .btn-export:hover {
        background: linear-gradient(135deg, #5da9b0, #2c6a74);
        box-shadow: 0 6px 16px rgba(44, 106, 116, 0.6);
    }

    .search-box {
        position: relative;
        width: 100%;
        max-width: 350px;
        margin-bottom: 15px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border-radius: 30px;
        border: 2px solid #2c6a74;
        outline: none;
        font-size: 14px;
        color: #2c6a74;
        background-color: #f9fdfd;
        transition: all 0.3s ease-in-out;
    }

    .search-box input::placeholder {
        color: #5da9b0;
        font-style: italic;
    }

    .search-box input:focus {
        border-color: #5da9b0;
        box-shadow: 0 0 8px rgba(45, 120, 128, 0.3);
        background-color: #ffffff;
    }

    /* Ikon kaca pembesar */
    .search-box .fa-search {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #5da9b0;
        font-size: 14px;
    }
</style>

<body>
<div class="container-fluid py-2">
<div class="row align-items-center mb-2">
    <!-- Judul -->
    <div class="col-md-6 col-12">
        <h3 class="mb-2 h4 fw-bold">Data Kehadiran</h3>
    </div>

    <!-- Tombol-tombol -->
    <div class="col-md-6 col-12 text-md-end text-start mt-2 mt-md-0">
        <div class="d-flex flex-wrap gap-2 justify-content-md-end justify-content-start">
        <?php if (!$siswa_kosong): ?>
            <a href="javascript:void(0);" class="btn tab-kategori" onclick="tampilkanForm()">
            <i class="fas fa-plus"></i> Tambah
            </a>
        <?php endif; ?>
            <a href="<?= base_url('index.php/kehadiran/export_pdf') ?>" target="_blank" class="btn tab-kategori">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="<?= base_url('index.php/kehadiran/excel') ?>" class="btn tab-kategori">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="javascript:void(0);" class="btn tab-kategori" data-toggle="modal" data-target="#modalLaporanPerSiswa">
                <i class="fas fa-file-pdf"></i> Laporan Per Siswa (PDF)
            </a>
        </div>
    </div>
</div>
</div>

    <!-- Modal Laporan Per Siswa -->
    <div class="modal fade" id="modalLaporanPerSiswa" tabindex="-1" role="dialog" aria-labelledby="modalLabelSiswa" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modern-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelSiswa">Laporan Kehadiran Per Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="input-siswa-pdf" class="label-input">Cari Siswa</label>
                    <input type="text" id="input-siswa-pdf" class="form-control" placeholder="Ketik nama siswa..." oninput="this.value = this.value.toUpperCase();">
                    <input type="hidden" id="nisn-siswa-pdf">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-export" onclick="exportPerSiswa();">Export PDF</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card h-100 w-100">
                <div class="card-body p-3">
                    <?php if ($siswa_kosong): ?>
                        <div class="text-center p-5">
                            <h4 class="text-danger">Data Siswa Kosong</h4>
                            <p>Masukkan Data Siswa terlebih dahulu untuk mengelola data kehadiran.</p>
                            <a href="<?= base_url('data_siswa') ?>" class="btn btn-primary mt-3">
                                <i class="fas fa-user-plus"></i> Input Data Siswa
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="search-input" 
                                class="form-control"
                                placeholder="Cari data kehadiran..." 
                                oninput="this.value = this.value.toUpperCase();">
                            </div>
                            <table class="table table-bordered text-dark text-sm w-100 align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%;">NO.</th>
                                        <th class="text-center" style="width: 15%;">NISN</th>
                                        <th class="text-center" style="width: 20%;">TANGGAL/BULAN</th>
                                        <th class="text-center" style="width: 25%;">NAMA SISWA</th>
                                        <th class="text-center" style="width: 15%;">KELAS</th>
                                        <th class="text-center" style="width: 15%;">KETERANGAN</th>
                                        <th class="text-center" style="width: 15%;">POIN</th>
                                        <th class="text-center" style="width: 20%;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="target">
                                    <!-- Data akan diisi melalui JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    
            <div id="form-kehadiran">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 text-center">FORM INPUT KEHADIRAN</h5>
                        <p id="pesan" class="text-danger text-center"></p>
                        <form id="kehadiran-form">
                            <input type="hidden" name="id">

                            <div class="form-group">
                                <label class="group">Tanggal:</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="group">Nama:</label>
                                <input type="text" name="nama_siswa" id="nama_input" class="form-control" id="nama_siswa_display" list="list-nama_siswa" placeholder="Nama Siswa" oninput="this.value = this.value.toUpperCase();">
                                <datalist id="list-nama_siswa">
                                    <?php foreach ($siswa as $row): ?>
                                        <option value="<?= $row->nama_siswa ?>"></option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>

                            <div class="form-group">
                                <label class="group">NISN:</label>
                                <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN" readonly>
                            </div>

                            <div class="form-group">
                                <label class="group">Kelas:</label>
                                <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Kelas" readonly>
                            </div>

                            <div class="form-group">
                                <label class="group">Wali Kelas:</label>
                                <input type="text" class="form-control" name="wali_kelas" id="wali_kelas" placeholder="Wali Kelas" readonly>
                            </div>

                            <div class="form-group">
                                <label class="group">Keterangan:</label>
                                <input type="text" id="input_display" class="form-control text-uppercase" maxlength="10" placeholder="Masukkan A">
                                <small id="keterangan-deskripsi" class="form-text text-light mt-1"></small>
                            </div>
                                
                            <input type="hidden" id="input_keterangan" name="keterangan">

                            <div class="form-group">
                                <label class="group">Poin:</label>
                                <input type="number" id="poin" name="poin" class="form-control" readonly required placeholder="Poin">
                            </div>

                            <div class="text-end d-flex justify-content-end mt-4">
                                <button type="button" onclick="sembunyikanForm()" class="btn btn-custom-submit">Batal</button>
                                <button type="button" onclick="tambahdata()" class="btn btn-custom-submit ml-2">Tambah</button>
                                <button type="button" id="btn-ubah" onclick="ubahdata()" class="btn btn-custom-submit ml-2" style="display:none;">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        ambilData();

        // Fungsi untuk memformat tanggal dari ISO ke format DD-MM-YYYY
        function formatTanggal(isoDate) {
            const date = new Date(isoDate);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
        
        function exportPerSiswa() {
            var nisn = $("#nisn-siswa-pdf").val();
            if (nisn === "") {
                alert("Silakan pilih siswa dari daftar autocomplete!");
                return;
            }
            window.open("<?= base_url('index.php/kehadiran/laporan_persiswa/') ?>" + nisn, "_blank");

            // Reset input setelah export
            document.getElementById('input-siswa-pdf').value = '';
            document.getElementById('nisn-siswa-pdf').value = '';
        }

        function formatTanggal(isoDate) {
            const date = new Date(isoDate);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); 
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Ambil dan tampilkan seluruh data kehadiran dari server via AJAX
        function ambilData() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/kehadiran/ambildata") ?>',
                dataType: 'json',
                success: function(hasil) {
                    var baris = '';
                    for (var i = 0; i < hasil.length; i++) {
                        baris += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td>' + hasil[i].nisn + '</td>' +
                            '<td>' + formatTanggal(hasil[i].tanggal) + '</td>' +
                            '<td>' + hasil[i].nama_siswa + '</td>' +
                            '<td>' + hasil[i].kelas + '</td>' +
                            '<td>' + hasil[i].keterangan + '</td>' +
                            '<td>' + hasil[i].poin + '</td>' +
                            '<td class="td-aksi">' +
                            '<div class="d-flex justify-content-center gap-2">' +
                            '<a href="<?= base_url("index.php/kehadiran/detail/") ?>' + hasil[i].id + '" class="btn btn-sm btn-custom-detail">' +
                            '<i class="fas fa-eye"></i> Detail</a>' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="hapusData(' + hasil[i].id + ')">' +
                            '<i class="fas fa-trash-alt"></i> Hapus</a>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                    }
                    // Tampilkan hasil ke tabel
                    $('#target').html(baris);
                }
            });
        }

        // Fungsi cari data kehadiran
        $(document).ready(function () {
            $("#search-input").on("keyup", function () {
                var value = $(this).val().toUpperCase();
                $("#target tr").filter(function () {
                    $(this).toggle($(this).text().toUpperCase().indexOf(value) > -1);
                });
            });
        });

        function tampilkanForm() {
            $('#form-kehadiran').show();
            $('#kehadiran-form')[0].reset();
            $('#pesan').html('');
            $('[name="id"]').val('');

            // Set tanggal otomatis ke hari ini
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;
            $('[name="tanggal"]').val(todayStr);
        }

        function sembunyikanForm() {
            $('#form-kehadiran').hide();
            $('#pesan').html('');

            $('#btn-ubah').hide();
            $('.btn-custom-submit:contains("Tambah")').show();
        }

        function tambahdata() {
            var nisn = $("[name='nisn']").val();
            var tanggal = $("[name='tanggal']").val();
            var nama_siswa = $("[name='nama_siswa']").val();
            var kelas = $("[name='kelas']").val();
            var keterangan = $("[name='keterangan']").val();
            var poin = $("[name='poin']").val();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/kehadiran/tambahdata") ?>',
                data: {
                    tanggal: tanggal,
                    nisn: nisn,
                    keterangan: keterangan,
                    poin: poin
                },
                dataType: 'json',
                success: function(hasil) {
                    $("#pesan").html(hasil.pesan);
                    if (hasil.pesan == '') {
                        ambilData(); 
                        sembunyikanForm(); 
                    }
                }
            });
        }

        // function editData(id) {
        //     $('#form-kehadiran').show();
        //     $('#kehadiran-form')[0].reset();
        //     $('#pesan').html('');
        //     $('#btn-ubah').show();
        //     $('.btn-custom-submit:contains("Tambah")').hide(); // Sembunyikan tombol Tambah

        //     $.ajax({
        //         type: 'POST',
        //         url: '<?php echo base_url("index.php/kehadiran/ambilId") ?>',
        //         data: { id: id },
        //         dataType: 'json',
        //         success: function(hasil) {
        //             $('[name="id"]').val(hasil[0].id);
        //             $('[name="nisn"]').val(hasil[0].nisn);
        //             $('[name="tanggal"]').val(hasil[0].tanggal);
        //             $('[name="nama_siswa"]').val(hasil[0].nama_siswa);
        //             $('[name="kelas"]').val(hasil[0].kelas);
        //             $('[name="wali_kelas"]').val(hasil[0].wali_kelas);
        //             $('[name="keterangan"]').val(hasil[0].keterangan);
        //             $('[name="poin"]').val(hasil[0].poin);
        //         }
        //     });
        // }

        function hapusData(id) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url("index.php/kehadiran/hapusdata") ?>',
                    data: { id: id },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === true) {
                            ambilData(); // Refresh tabel
                            alert("Data berhasil dihapus.");
                        } else {
                            alert("Gagal menghapus data.");
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan saat menghapus.");
                    }
                });
            }
        }

        // function submit(id) {
        //     if (id === 'tambah') {
        //         $('#btn-tambah').show();
        //         $('#btn-ubah').hide();
        //     } else {


        //         $.ajax({
        //             type: 'POST',
        //             url: '<?php echo base_url("index.php/kehadiran/ambilId") ?>',
        //             data: {
        //                 id: id
        //             },
        //             dataType: 'json',
        //             success: function(hasil) {
        //                 $('[name="nisn"]').val(hasil[0].nisn);
        //                 $('[name="tanggal"]').val(hasil[0].tanggal);
        //                 $('[name="id"]').val(hasil[0].id);
        //                 $('[name="_siswa"]').val(hasil[0].nama_siswa);
        //                 $('[name="kelas"]').val(hasil[0].kelas);
        //                 $('[name="keterangan"]').val(hasil[0].keterangan);
        //             }
        //         });
        //     }
        // }
    </script>

    <script>
        $(function () {
            $("#input-siswa-pdf").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "<?= base_url('kehadiran/get_autocomplete_siswa') ?>",
                        dataType: "json",
                        data: { term: request.term },
                        success: function (data) {
                            response($.map(data, function (item) {
                                return {
                                    label: item.nama_siswa + " (" + item.kelas + ")",
                                    value: item.nama_siswa,
                                    nisn: item.nisn
                                };
                            }));
                        }
                    });
                },
                minLength: 1,
                select: function (event, ui) {
                    $("#input-siswa-pdf").val(ui.item.value);
                    $("#nisn-siswa-pdf").val(ui.item.nisn);
                    return false;
                },
                appendTo: "#modalLaporanPerSiswa"
            });
        });

        function exportPerSiswa() {
            var nisn = $("#nisn-siswa-pdf").val();
            if (!nisn) {
                alert("Silakan pilih siswa dari daftar!");
                return;
            }

            // Buka PDF
            window.open("<?= base_url('kehadiran/laporan_persiswa/') ?>" + nisn, "_blank");

            // Reset form setelah export
            resetFormSiswa();
        }

        function resetFormSiswa() {
            $("#input-siswa-pdf").val('');
            $("#nisn-siswa-pdf").val('');
        }
    </script>
    
    <script>
        if (document.querySelector('.input-group input')) {
            var inputs = document.querySelectorAll('.input-group input');
            inputs.forEach(input => {
            if (input.value != "") {
                input.parentElement.classList.add("is-filled");
            }

            input.addEventListener("focus", function () {
                input.parentElement.classList.add("is-focused");
            });

            input.addEventListener("blur", function () {
                if (input.value == "") {
                input.parentElement.classList.remove("is-filled");
                }
                input.parentElement.classList.remove("is-focused");
            });
            });
        }
    </script>

    <!-- <script>
        const keteranganInput = document.getElementById('keterangan_input');
        const poinInput = document.querySelector('input[name="poin"]');

        keteranganInput.addEventListener('input', function () {
            const ket = keteranganInput.value.trim().toLowerCase();
            if (ket === 'alpha') {
                poinInput.value = 1;
            }
        });
    </script>

    <script>
    $(document).ready(function() {
        $('#nisn').change(function() {
            var nisn = $(this).val();
            if(nisn != '') {
                $.ajax({
                    url: "<?php echo base_url('data_siswa/get_detail_siswa'); ?>",
                    method: "POST",
                    data: { nisn: nisn },
                    dataType: "json",
                    success: function(data) {
                        $('#nama_siswa').val(data.nama_siswa);
                        $('#kelas').val(data.kelas);
                        $('#wali_kelas').val(data.wali_kelas);
                    }
                });
            } else {
                $('#nama_siswa').val('');
                $('#kelas').val('');
                $('#wali_kelas').val('');
            }
        });
    });
    </script> -->

    <script>
        const siswaList = [
            <?php foreach ($siswa as $row): ?> {
                nama_siswa: "<?= addslashes($row->nama_siswa) ?>",
                nisn: "<?= $row->nisn ?>",
                kelas: "<?= $row->kelas ?>",
                wali_kelas: "<?= $row->wali_kelas ?>"
            },
            <?php endforeach; ?>
        ];
    </script>

    <script>
        const inputNama = document.getElementById('nama_input');

        function isiOtomatis() {
            const nama_siswa = inputNama.value.trim();
            const siswa = siswaList.find(s => s.nama_siswa.toLowerCase().trim() === nama_siswa.toLowerCase().trim());

            if (siswa) {
                document.getElementById('nisn').value = siswa.nisn;
                document.getElementById('kelas').value = siswa.kelas;
                document.getElementById('wali_kelas').value = siswa.wali_kelas;
            } else {
                document.getElementById('nisn').value = '';
                document.getElementById('kelas').value = '';
                document.getElementById('wali_kelas').value = '';
            }
        }

        // Tangkap baik dari input manual atau memilih dari datalist
        inputNama.addEventListener('input', isiOtomatis);
        inputNama.addEventListener('change', isiOtomatis);
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputDisplay = document.getElementById('input_display');
        const inputHidden = document.getElementById('input_keterangan');
        const poinInput = document.getElementById('poin');

        inputDisplay.addEventListener('input', function () {
            let val = this.value.trim().toUpperCase();

            if (val === 'A' || val.startsWith('A')) {
                this.value = 'A (10 JAM)';
                inputHidden.value = 'A'; 
                poinInput.value = 7;
            } else {
                this.value = '';
                inputHidden.value = '';
                poinInput.value = '';
            }
        });
    });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>