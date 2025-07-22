<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        margin-top: 10px; /* atau 5px */
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

    .group{
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


</style>

<body>
<div class="container-fluid py-2">
<div class="row align-items-center mb-2">
  <!-- Judul -->
  <div class="col-md-6 col-12">
    <h3 class="mb-2 h4 fw-bold">Data Pelanggaran</h3>
  </div>

  <!-- Tombol-tombol -->
  <div class="col-md-6 col-12 text-md-end text-start mt-2 mt-md-0">
    <div class="d-flex flex-wrap gap-2 justify-content-md-end justify-content-start">
      <a href="javascript:void(0);" class="btn tab-kategori" onclick="tampilkanForm()">
        <i class="fas fa-plus"></i> Tambah
      </a>
      <a href="<?= base_url('index.php/pelanggaran/export_pdf') ?>" target="_blank" class="btn tab-kategori">
        <i class="fas fa-file-pdf"></i> Export PDF
      </a>
      <a href="<?= base_url('index.php/pelanggaran/excel') ?>" class="btn tab-kategori">
        <i class="fas fa-file-excel"></i> Export Excel
      </a>
    </div>
  </div>
</div>
</div>


  <div class="row">
    <div class="col-12">
      <div class="card h-100 w-100">
        <div class="card-body p-3">
          <div class="table-responsive">
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
                <!-- Data akan diisi melalui JavaScript -->
              </tbody>
            </table>

            <!-- Modal Form Pelanggaran -->
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
                                <label class="group">Kode:</label>
                            <input type="text" name="kode" class="form-control" list="list-kode" placeholder="Contoh: A-2 atau kata kunci" oninput="isiDetailPelanggaran(this.value);">
                            <datalist id="list-kode">
                                <?php foreach ($kodeMap as $kode => $detail): ?>
                                    <option value="<?= $kode ?>"><?= $detail['jenis'] ?></option>
                                <?php endforeach; ?>
                            </datalist>
                            </div>
                            <div class="form-group">
                                <label class="group">Jenis Pelanggaran:</label>
                                <input type="text" name="keterangan" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label class="group">Poin:</label>
                                <input type="number" name="poin" class="form-control" readonly>
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
            <!-- End Modal Form -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
        ambilData();

        function ambilData() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/pelanggaran/ambildata") ?>',
                dataType: 'json',
                success: function(hasil) {
                    var baris = '';
                    for (var i = 0; i < hasil.length; i++) {
                        baris += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td>' + hasil[i].nisn + '</td>' +
                            '<td>' + hasil[i].tanggal + '</td>' +
                            '<td>' + hasil[i].nama_siswa + '</td>' +
                            '<td>' + hasil[i].kelas + '</td>' +
                            '<td>' + hasil[i].kode + '</td>' +
                            '<td class="td-aksi">' +
                            '<a href="javascript:void(0);" class="btn custom-btn btn-sm" onclick="editData(' + hasil[i].id + ')">' +
                            ' <i class="fas fa-edit"></i> Edit</a>' +
                            '<a href="<?= base_url("index.php/pelanggaran/detail/") ?>' + hasil[i].id + '" class="btn custom-btn btn-sm">' +
                            '<i class="fas fa-eye"></i> Detail</a>' +
                            '</td>'

                        '</tr>';
                    }
                    $('#target').html(baris);
                }
            });
        }

        function tampilkanForm() {
            $('#form-pelanggaran').show();
            $('#pelanggaran-form')[0].reset();
            $('#pesan').html('');
            $('[name="id"]').val('');
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
            var kode = $("[name='kode']").val();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/pelanggaran/tambahdata") ?>',
                data: {
                    tanggal: tanggal,
                    nama_siswa: nama_siswa,
                    nisn: nisn,
                    kelas: kelas,
                    wali_kelas: $("[name='wali_kelas']").val(),
                    kode: kode,
                    keterangan: $("[name='keterangan']").val(),
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
        const kodeMap = <?php echo json_encode([
            "A-1" => ["jenis" => "Tidak membawa alat atau bahan pembelajaran yang disepakati", "poin" => 10],
            "A-2" => ["jenis" => "Membuat kegaduhan di kelas atau di sekolah", "poin" => 200],
            // dst...
        ]); ?>;

        function isiDetailPelanggaran(input) {
            const keyword = input.trim().toUpperCase();
            let foundKode = '';

            // Cek apakah input adalah kode langsung
            if (kodeMap[keyword]) {
                foundKode = keyword;
            } else {
                // Cari berdasarkan kata kunci dalam keterangan
                for (const [kode, data] of Object.entries(kodeMap)) {
                    if (data.jenis.toUpperCase().includes(keyword)) {
                        foundKode = kode;
                        break;
                    }
                }
            }

            if (foundKode) {
                $("[name='kode']").val(foundKode); // Tetap isi kode
                $("[name='keterangan']").val(kodeMap[foundKode].jenis);
                $("[name='poin']").val(kodeMap[foundKode].poin);
            } else {
                $("[name='keterangan']").val('');
                $("[name='poin']").val('');
            }
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
