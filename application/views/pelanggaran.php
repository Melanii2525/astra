<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="assets/js/material-dashboard.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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

    .card.h-100.w-100 {
        margin-top: 10px;
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

    .td-aksi {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding-top: 5px;
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

    #form-pelanggaran {
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

    #form-pelanggaran .card {
        width: 90%;
        max-width: 500px;
        margin: 50px auto;
        background-color: #2C6A74;
        color: white;
        border-radius: 20px;
        padding: 20px;
    }

    @media (max-width: 576px) {
        #form-pelanggaran .card {
            width: 95%;
            padding: 15px;
            margin: 20px auto;
        }

        .form-group label.group {
            font-size: 14px;
        }

        .form-control {
            font-size: 14px;
        }

        .btn-custom-submit {
            font-size: 14px;
            padding: 6px 16px;
        }

        .td-aksi a.btn {
            font-size: 12px;
            padding: 5px 10px;
        }
    }

    .ui-autocomplete {
        position: absolute;
        z-index: 2000 !important;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        font-size: 14px;
    }

    .modal,
    .modal-dialog,
    .modal-content {
        overflow: visible !important;
    }

    .modern-modal {
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(44, 106, 116, 0.3);
        border: none;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .modern-modal .modal-header {
        background: linear-gradient(135deg, #2c6a74, #5da9b0);
        color: #d0efef;
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        font-size: 1.25rem;
        align-items: center;
    }

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

    .modern-modal .modal-body {
        padding: 1.5rem;
        background-color: #d0efef;
        color: #2c6a74;
    }

    .modern-modal .label-input {
        display: block;
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: #2c6a74;
    }

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

    .modern-modal .modal-footer {
        background-color: #aee3e0;
        border-top: none;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.8rem;
    }

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

    .modern-modal .btn-cancel {
        background-color: #5da9b0;
        color: #d0efef;
    }

    .modern-modal .btn-cancel:hover {
        background-color: #2c6a74;
        color: #aee3e0;
    }

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
        <div class="col-md-6 col-12">
            <h3 class="mb-2 h4 fw-bold">Data Pelanggaran</h3>
        </div>

        <div class="col-md-6 col-12 text-md-end text-start mt-2 mt-md-0">
            <div class="d-flex flex-wrap gap-2 justify-content-md-end justify-content-start">
            <?php if (!$siswa_kosong): ?>
                <a href="javascript:void(0);" class="btn tab-kategori" onclick="tampilkanForm()">
                <i class="fas fa-plus"></i> Tambah
                </a>
            <?php endif; ?>
                <a href="<?= base_url('index.php/pelanggaran/export_pdf') ?>" target="_blank" class="btn tab-kategori">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="<?= base_url('index.php/pelanggaran/excel') ?>" class="btn tab-kategori">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                <a href="javascript:void(0);" class="btn tab-kategori" data-toggle="modal" data-target="#modalLaporanPerSiswa">
                    <i class="fas fa-file-pdf"></i> Laporan Per Siswa (PDF)
                </a>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="modalLaporanPerSiswa" tabindex="-1" role="dialog" aria-labelledby="modalLabelSiswa" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modern-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelSiswa">Laporan Pelanggaran Per Siswa</h5>
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
                            <p>Masukkan Data Siswa terlebih dahulu untuk mengelola data pelanggaran.</p>
                            <a href="<?= base_url('data_siswa') ?>" class="btn btn-primary mt-3">
                                <i class="fas fa-user-plus"></i> Input Data Siswa
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchInput"
                                    class="form-control"
                                    placeholder="Cari data pelanggaran..."
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
                                        <th class="text-center" style="width: 15%;">KODE</th>
                                        <th class="text-center" style="width: 20%;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="target">
                                </tbody>
                                </table>
                        </div>
                    <?php endif; ?>

                    <div id="form-pelanggaran">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-4 text-center">FORM INPUT PELANGGARAN</h5>
                                <p id="pesan" class="text-danger text-center"></p>
                                <form id="pelanggaran-form">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label class="group">Tanggal:</label>
                                        <input type="date" name="tanggal" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="group">Nama:</label>
                                        <input type="text" name="nama_siswa" id="nama_input" class="form-control" list="list-nama_siswa" placeholder="Nama Siswa" oninput="this.value = this.value.toUpperCase();">
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
                                        <label class="group">Jenis Pelanggaran:</label>
                                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Cari jenis pelanggaran...">
                                    </div>

                                    <div class="form-group">
                                        <label class="group">Kode & Kategori:</label>
                                        <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode pelanggaran" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="group">Poin:</label>
                                        <input type="text" name="poin" id="poin" class="form-control" placeholder="Poin" readonly>
                                    </div>
                                    <div class="text-end d-flex flex-wrap justify-content-end gap-2 mt-4">
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
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript">
        ambilData();

        function exportPerSiswa() {
            var nisn = $("#nisn-siswa-pdf").val();
            if (nisn === "") {
                alert("Silakan pilih siswa dari daftar autocomplete!");
                return;
            }
            window.open("<?= base_url('index.php/pelanggaran/laporan_persiswa/') ?>" + nisn, "_blank");

            document.getElementById('input-siswa-pdf').value = '';
            document.getElementById('nisn-siswa-pdf').value = '';
        }

        function ambilData() {
            var keyword = $('#searchInput').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/pelanggaran/ambildata") ?>',
                data: { search: keyword }, 
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
                            '<td>' + hasil[i].kode + '</td>' +
                            '<td class="td-aksi">' +
                                '<a href="javascript:void(0);" class="btn custom-btn btn-sm" onclick="editData(' + hasil[i].id + ')">' +
                                    '<i class="fas fa-edit"></i> Edit</a>' +
                                '<a href="<?= base_url("index.php/pelanggaran/detail/") ?>' + hasil[i].id + '" class="btn custom-btn btn-sm">' +
                                    '<i class="fas fa-eye"></i> Detail</a>' +
                            '</td>' +
                        '</tr>';
                    }
                    $('#target').html(baris);
                }
            });
        }

        $('#searchInput').on('input', function() {
            ambilData();
        });

        function formatTanggal(tanggal) {
            var parts = tanggal.split('-'); 
            return parts[2] + '-' + parts[1] + '-' + parts[0]; 
        }

        function tampilkanForm() {
            $('#form-pelanggaran').show();
            $('#pelanggaran-form')[0].reset();
            $('#pesan').html('');
            $('[name="id"]').val('');

            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;
            $('[name="tanggal"]').val(todayStr);
        }

        function sembunyikanForm() {
            $('#form-pelanggaran').hide();
            $('#pesan').html('');

            $('#btn-ubah').hide();
            $('.btn-custom-submit:contains("Tambah")').show();
        }

        function tambahdata() {
            var nisn = $("[name='nisn']").val();
            var tanggal = $("[name='tanggal']").val();
            var nama_siswa = $("[name='nama_siswa']").val();
            var kelas = $("[name='kelas']").val();
            var kode = $("[name='kode']").val().toUpperCase();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/pelanggaran/tambahdata") ?>',
                data: {
                    tanggal: tanggal,
                    nama_siswa: nama_siswa,
                    nisn: nisn,
                    kelas: kelas,
                    wali_kelas: $("[name='wali_kelas']").val(),
                    keterangan: $("[name='deskripsi']").val(),
                    kode: kode,
                    poin: $("[name='poin']").val()
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

        function editData(id) {
            $('#form-pelanggaran').show();
            $('#pelanggaran-form')[0].reset();
            $('#pesan').html('');
            $('#btn-ubah').show();
            $('.btn-custom-submit:contains("Tambah")').hide(); 

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/pelanggaran/ambilId") ?>',
                data: { id: id },
                dataType: 'json',
                success: function(hasil) {
                    $('[name="id"]').val(hasil[0].id);
                    $('[name="nisn"]').val(hasil[0].nisn);
                    $('[name="tanggal"]').val(hasil[0].tanggal);
                    $('[name="nama_siswa"]').val(hasil[0].nama_siswa);
                    $('[name="kelas"]').val(hasil[0].kelas);
                    $('[name="wali_kelas"]').val(hasil[0].wali_kelas);
                    $('[name="kode"]').val(hasil[0].kode);
                    $('[name="deskripsi"]').val(hasil[0].keterangan); 
                    $('[name="poin"]').val(hasil[0].poin); 

                    isiDetailPelanggaran(hasil[0].kode);
                }
            });
        }

        function ubahdata() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/pelanggaran/ubahdata") ?>',
                data: $('#pelanggaran-form').serialize(),
                dataType: 'json',
                success: function(hasil) {
                    $('#pesan').html(hasil.pesan);
                    if (hasil.pesan == '') {
                        ambilData();
                        sembunyikanForm();
                        $('#btn-ubah').hide();
                        $('.btn-custom-submit:contains("Tambah")').show();
                    }
                }
            });
        }

        function submit(id) {
            if (id === 'tambah') {
                $('#btn-tambah').show();
                $('#btn-ubah').hide();
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url("index.php/pelanggaran/ambilId") ?>',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(hasil) {
                        $('[name="nisn"]').val(hasil[0].nisn);
                        $('[name="tanggal"]').val(hasil[0].tanggal);
                        $('[name="id"]').val(hasil[0].id);
                        $('[name="nama_siswa"]').val(hasil[0].nama_siswa);
                        $('[name="kelas"]').val(hasil[0].kelas);
                        $('[name="kode"]').val(hasil[0].kode);
                    }
                });
            }
        }
    </script>

    <script>
        $(function() {
            $("#deskripsi").autocomplete({
                source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('index.php/pelanggaran/get_autocomplete_jenis') ?>",
                    dataType: "json",
                    data: {
                    term: request.term
                    },
                    success: function(data) {
                    response(data);
                    }
                });
                },
                select: function(event, ui) {
                $("#deskripsi").val(ui.item.value); 
                $("#kode").val(ui.item.kode);       
                $("#poin").val(ui.item.poin);      
                return false;
                },
                appendTo: "body" 
            });
        });
    </script>

    <script>
        $(function () {
            $("#input-siswa-pdf").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "<?= base_url('pelanggaran/get_autocomplete_siswa') ?>",
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

            window.open("<?= base_url('pelanggaran/laporan_persiswa/') ?>" + nisn, "_blank");
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

        inputNama.addEventListener('input', isiOtomatis);
        inputNama.addEventListener('change', isiOtomatis);
    </script>

    <script>
        $(document).ready(function () {
            $("#btn-tambah").click(function () {
                $("#formTambahData").trigger("reset");
                $("#modalTambah").modal("show");
            });
        });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>