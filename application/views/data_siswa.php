<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Manajemen Data Siswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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

    .table th,
    .table td {
      vertical-align: middle !important;
    }

    .thead-custom {
      background-color: #2c6a74;
    }

    .thead-custom th {
      color: white;
    }

    #searchInput {
      border: 2px solid #2c6a74;
      border-radius: 30px;
      padding: 10px 20px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      margin-right: 10px;
    }

    #searchInput:focus {
      border-color: #5da9b0;
      box-shadow: 0 0 8px rgba(45, 120, 128, 0.3);
      outline: none;
    }

    #searchInput::placeholder {
      color: #999;
      font-style: italic;
    }

    .badge-status {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.25rem 0.75rem; /* samakan dengan .btn-sm */
  font-size: 0.850rem;       /* sama dengan btn-sm */
  font-weight: 600;
  line-height: 1.5;
  border-radius: 0.25rem;
  min-height: 31px;          /* samakan tinggi minimal btn-sm */
  text-transform: uppercase;
}

.badge-status.aktif {
  background-color: #28a745;
  color: #fff;
}

.badge-status.nonaktif {
  background-color: #dc3545;
  color: #fff;
}
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container py-5">
    <h3 class="text-center mb-4 font-weight-bold text-dark">Manajemen Data Siswa</h3>
    <div class="accordion mb-4" id="inputAccordion">
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
              <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-upload mr-1"></i> Import
                </button>
                <a href="<?= base_url('assets/template/template_siswa.xlsx') ?>" class="btn btn-warning ml-2" download>
                  <i class="fas fa-download mr-1"></i> Download Template
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1080;">
      <div id="toastSukses" class="toast toast-success fade" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
        <div class="toast-header bg-success text-white">
          <strong class="mr-auto"><i class="fas fa-check-circle mr-2"></i> Berhasil</strong>
          <button type="button" class="ml-2 mb-1 close text-white btn-close-toast">&times;</button>
        </div>
        <div class="toast-body">Data siswa berhasil disimpan!</div>
      </div>

      <div id="toastError" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header bg-danger text-white">
          <strong class="mr-auto"><i class="fas fa-exclamation-circle mr-2"></i> Gagal</strong>
          <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body" id="toastErrorBody">Terjadi kesalahan saat menyimpan data.</div>
      </div>

      <?php if ($this->session->flashdata('sukses')): ?>
        <div class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500" id="toastFlashSukses">
          <div class="toast-header bg-success text-white">
            <strong class="mr-auto"><i class="fas fa-check-circle mr-2"></i> Berhasil</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
          </div>
          <div class="toast-body">
            <?= $this->session->flashdata('sukses') ?>
          </div>
        </div>
      <?php elseif ($this->session->flashdata('error')): ?>
        <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" id="toastFlashError">
          <div class="toast-header bg-danger text-white">
            <strong class="mr-auto"><i class="fas fa-exclamation-circle mr-2"></i> Gagal</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
          </div>
          <div class="toast-body">
            <?= $this->session->flashdata('error') ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="d-flex justify-content-end mb-2">
      <input type="text" id="searchInput" class="form-control w-25" placeholder="Search..." oninput="this.value = this.value.toUpperCase()">
      <button class="btn btn-danger" onclick="hapusSemuaSiswa()">
        <i class="fas fa-trash-alt mr-1"></i> Hapus Semua Data
      </button>
    </div>

    <h5 class="font-weight-bold mb-3 mt-2">Daftar Siswa Terdata</h5>
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
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tabelSiswa"></tbody>
      </table>
      <div id="paginationSiswa" class="mt-3"></div>
    </div>
  </div>

  <div class="modal fade" id="modalFoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="formUploadFoto" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title">Upload Foto Siswa</h5>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_siswa" id="idSiswaFoto">
            <div class="form-group">
              <label>Nama Siswa</label>
              <input type="text" class="form-control" id="namaSiswaFoto" readonly>
            </div>
            <div class="form-group">
              <label>Pilih Foto (jpg/png)</label>
              <input type="file" class="form-control-file" name="foto_siswa" accept="image/*" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Upload</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      ambilData();

      $('#toastSukses').toast({
        autohide: true,
        delay: 1500
      });
      $('#toastError').toast({
        autohide: true,
        delay: 2000
      });

      if ($("#toastFlashSukses").length) {
        $("#toastFlashSukses").toast({
          autohide: true,
          delay: 1500
        }).toast('show');
      }

      if ($("#toastFlashError").length) {
        $("#toastFlashError").toast({
          autohide: true,
          delay: 2000
        }).toast('show');
      }

      $('.btn-close-toast').on('click', function() {
        $(this).closest('.toast').toast('hide');
      });
    });

    let currentPage = 1;

    function ambilData(page = 1) {
      $.ajax({
        type: "GET",
        url: "<?= base_url('data_siswa/ambildata') ?>",
        data: {
          page: page
        },
        dataType: "json",
        success: function(res) {
          renderTable(res.siswa);
          renderPagination(res.page, res.total_page);
        },
        error: function() {
          alert("Gagal ambil data");
        }
      });
    }

    function renderPagination(current, totalPages) {
      let html = '<nav><ul class="pagination justify-content-center">';
      for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === current ? 'active' : ''}">
                <a class="page-link" href="#" onclick="ambilData(${i})">${i}</a>
              </li>`;
      }
      html += '</ul></nav>';
      $("#paginationSiswa").html(html);
    }

    function hapusSemuaSiswa() {
      if (confirm("Yakin ingin menghapus semua data siswa? Tindakan ini tidak bisa dibatalkan.")) {
        $.ajax({
          type: "POST",
          url: "<?= base_url('index.php/data_siswa/hapus_semua') ?>",
          success: function(res) {
            ambilData(); 
            alert("Semua data siswa berhasil dihapus.");
          },
          error: function() {
            alert("Terjadi kesalahan saat menghapus data.");
          }
        });
      }
    }

    function renderTable(data) {
      let html = "";
      let no = 1;

      data.forEach(item => {
        let btnFoto = "";
        if (item.foto && item.foto !== "") {
          btnFoto = `
            <a href="<?= base_url('uploads/foto_siswa/') ?>${item.foto}" 
              target="_blank" class="btn btn-sm btn-success">
              <i class="fas fa-image"></i> Lihat Foto
            </a>
            <button class="btn btn-sm btn-danger ml-1" 
                    onclick="hapusFoto('${item.id}')">
              <i class="fas fa-trash"></i> Hapus Foto
            </button>`;
          } else {
          btnFoto = `
            <button class="btn btn-sm btn-info" 
                    onclick="bukaModalFoto('${item.id}', '${item.nama_siswa}')">
              <i class="fas fa-camera"></i> Tambah Foto
            </button>`;
          }
          html += `
            <tr>
              <td>${no++}</td>
              <td>${item.nisn}</td>
              <td>${item.nipd}</td>
              <td>${item.nama_siswa}</td>
              <td>${item.kelas}</td>
              <td>${item.jenis_kelamin}</td>
              <td>${item.wali_kelas}</td>
              <td>
                <span class="badge-status ${item.status === 'aktif' ? 'aktif' : 'nonaktif'}">
                  ${item.status}
                </span>
              </td>
              <td>${btnFoto}</td>
            </tr>`;
      });

      $("#tabelSiswa").html(html);
    }

    $('#formSiswa').submit(function(e) {
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
        success: function(res) {
          if (res.pesan === '') {
            $('#formSiswa')[0].reset();
            ambilData();
            $('#toastSukses').toast('show');
          } else {
            $('#toastErrorBody').text(res.pesan || "Terjadi kesalahan saat menyimpan data.");
            $('#toastError').toast('show');
            $('#formSiswa')[0].reset();
          }
        }
      });
    });

    let searchKeyword = "";

    $("#searchInput").on("input", function() {
      searchKeyword = $(this).val();
      if (searchKeyword.trim() !== "") {
        cariData(1);
      } else {
        ambilData(1); 
      }
    });

    function cariData(page = 1) {
      $.ajax({
        type: "GET",
        url: "<?= base_url('data_siswa/cari_data') ?>",
        data: {
          keyword: searchKeyword,
          page: page
        },
        dataType: "json",
        success: function(res) {
          renderTable(res.siswa);
          renderPaginationSearch(res.page, res.total_page);
        },
        error: function() {
          alert("Gagal mencari data");
        }
      });
    }

    function renderPaginationSearch(current, totalPages) {
      let html = '<nav><ul class="pagination justify-content-center">';
      for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === current ? 'active' : ''}">
              <a class="page-link" href="#" onclick="cariData(${i})">${i}</a>
            </li>`;
      }
      html += '</ul></nav>';
      $("#paginationSiswa").html(html);
    }

    function bukaModalFoto(id, nama) {
      $("#idSiswaFoto").val(id);
      $("#namaSiswaFoto").val(nama);
      $("#modalFoto").modal("show");
    }

    $("#formUploadFoto").submit(function(e) {
      e.preventDefault();
      let formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?= base_url('index.php/data_siswa/upload_foto') ?>", 
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
          $("#modalFoto").modal("hide");
          ambilData(); 
          $('#toastSukses .toast-body').text("Foto berhasil diupload!");
          $('#toastSukses').toast('show');
        },
        error: function() {
          $('#toastErrorBody').text("Gagal upload foto.");
          $('#toastError').toast('show');
        }
      });
    });

    function hapusFoto(id) {
      if (confirm("Yakin ingin menghapus foto siswa ini?")) {
        $.ajax({
          type: "POST",
          url: "<?= base_url('index.php/data_siswa/hapus_foto') ?>",
          data: {
            id: id
          },
          dataType: "json",
          success: function(res) {
            if (res.status === "sukses") {
              ambilData(); 
              $('#toastSukses .toast-body').text("Foto berhasil dihapus!");
              $('#toastSukses').toast('show');
            } else {
              $('#toastErrorBody').text(res.error || "Gagal hapus foto.");
              $('#toastError').toast('show');
            }
          },
          error: function() {
            $('#toastErrorBody').text("Terjadi kesalahan saat menghapus foto.");
            $('#toastError').toast('show');
          }
        });
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>