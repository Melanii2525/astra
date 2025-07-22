<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Data Siswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Icons -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .card-header {
      background-color: #2c6a74;
      color: #fff;
    }

    .btn-link {
      text-decoration: none;
      color: white;
    }

    .btn-link:hover {
      color: #ffc107;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }

    .toast-success {
      background-color: #28a745;
      color: white;
    }

    .table th, .table td {
      vertical-align: middle !important;
    }

    .thead-custom {
      background-color: #2c6a74;
    }

    .thead-custom th {
      color: white;
    }
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container py-5">
  <h3 class="text-center mb-4 font-weight-bold text-dark">Manajemen Data Siswa</h3>

  <!-- Accordion Input -->
  <div class="accordion mb-4" id="inputAccordion">
    
    <!-- Input Manual -->
    <div class="card shadow-sm">
      <div class="card-header" id="headingManual">
        <h5 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseManual" aria-expanded="true">
            <i class="fas fa-pencil-alt mr-2"></i> Input Manual
          </button>
        </h5>
      </div>
      <div id="collapseManual" class="collapse show" data-parent="#inputAccordion">
        <div class="card-body">
          <form id="formSiswa">
            <input type="hidden" name="id">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="nisn">NISN</label>
                <input type="text" class="form-control" name="nisn" required>
              </div>
              <div class="form-group col-md-4">
                <label for="nipd">NIPD</label>
                <input type="text" class="form-control" name="nipd" required>
              </div>
              <div class="form-group col-md-4">
                <label for="nama_siswa">Nama</label>
                <input type="text" class="form-control" name="nama_siswa" required oninput="this.value = this.value.toUpperCase()">
              </div>
              <div class="form-group col-md-4">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" name="kelas" required oninput="this.value = this.value.toUpperCase()">
              </div>
              <div class="form-group col-md-4">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" required>
                  <option value="">-- Pilih --</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="wali_kelas">Wali Kelas</label>
                <input type="text" class="form-control" name="wali_kelas" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
              <i class="fas fa-save mr-1"></i> Simpan
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Import Excel -->
    <div class="card shadow-sm mt-3">
      <div class="card-header" id="headingExcel">
        <h5 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseExcel" aria-expanded="false">
            <i class="fas fa-file-excel mr-2"></i> Import dari Excel
          </button>
        </h5>
      </div>
      <div id="collapseExcel" class="collapse" data-parent="#inputAccordion">
        <div class="card-body">
          <form action="<?= base_url("index.php/data_siswa/import_excel") ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="excel_siswa">Upload File Excel</label>
              <input type="file" name="excel_siswa" class="form-control-file" accept=".xls,.xlsx" required>
            </div>
            <button type="submit" class="btn btn-success">
              <i class="fas fa-upload mr-1"></i> Import
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Success -->
  <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1080;">
    <div id="toastSukses" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
      <div class="toast-header bg-success text-white">
        <strong class="mr-auto"><i class="fas fa-check-circle mr-2"></i> Berhasil</strong>
        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
      </div>
      <div class="toast-body">Data siswa berhasil disimpan!</div>
    </div>
  </div>

  <!-- Table -->
  <h5 class="text-center font-weight-bold mb-3 mt-5">Daftar Siswa Terdata</h5>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-custom">
        <tr>
          <th>No</th>
          <th>NISN</th>
          <th>NIPD</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>JK</th>
          <th>Wali Kelas</th>
        </tr>
      </thead>
      <tbody id="tabelSiswa"></tbody>
    </table>
  </div>
</div>

<!-- AJAX -->
<script>
  $(document).ready(function () {
    ambilData();
  });

  function ambilData() {
    $.ajax({
      type: 'POST',
      url: '<?= base_url("index.php/data_siswa/ambildata") ?>',
      dataType: 'json',
      success: function (res) {
        const semuaData = [...res.kelas_x, ...res.kelas_xi, ...res.kelas_xii];
        renderTable(semuaData);
      }
    });
  }

  function renderTable(data) {
    let baris = '';
    for (let i = 0; i < data.length; i++) {
      baris += `
        <tr id="baris-${data[i].id}">
          <td>${i + 1}</td>
          <td>${data[i].nisn}</td>
          <td>${data[i].nipd}</td>
          <td>${data[i].nama_siswa}</td>
          <td>${data[i].kelas}</td>
          <td>${data[i].jenis_kelamin}</td>
          <td>${data[i].wali_kelas}</td>
        </tr>`;
    }
    $('#tabelSiswa').html(baris);
  }

  $('#formSiswa').submit(function (e) {
    e.preventDefault();
    const formData = {
      id: $("[name='id']").val(),
      nisn: $("[name='nisn']").val(),
      nipd: $("[name='nipd']").val(),
      nama_siswa: $("[name='nama_siswa']").val(),
      kelas: $("[name='kelas']").val(),
      jenis_kelamin: $("[name='jenis_kelamin']").val(),
      wali_kelas: $("[name='wali_kelas']").val()
    };

    const url = formData.id === "" ? '<?= base_url("index.php/data_siswa/tambahdata") ?>' : '<?= base_url("index.php/data_siswa/ubahdata") ?>';

    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      dataType: 'json',
      success: function (res) {
        if (res.pesan === '') {
          $('#formSiswa')[0].reset();
          ambilData();
          $('#toastSukses').toast('show');
        } else {
          alert(res.pesan);
        }
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
