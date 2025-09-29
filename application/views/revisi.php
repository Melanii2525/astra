  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  <script>
    const revisiData = <?= json_encode($revisi); ?>;
  </script>

  <style>
    .main-content {
      max-height: 100vh;
      overflow-y: auto;
    }

    .timeline {
      position: relative;
      padding-left: 40px;
      overflow: visible;
    }

    .timeline-item {
      position: relative;
      margin-bottom: 30px;
      overflow: visible;
    }

    .timeline-line {
      position: absolute;
      left: -18px;
      top: 0;
      width: 12px;
      height: 12px;
      background-color: #5da9b0;
      border-radius: 50%;
      border: 3px solid white;
      z-index: 2;
    }

    .timeline-line::after {
      content: '';
      position: absolute;
      left: 4px;
      top: 12px;
      width: 3px;
      height: calc(100% + 30px);
      background-color: #5da9b0;
    }

    .timeline:before {
      content: none !important;
    }

    .course-card {
      border-radius: 12px;
      padding: 20px;
      background-color: #aee3e0;
      color: white;
    }

    .course-title {
      font-weight: bold;
      font-size: 1.1rem;
      margin-bottom: 6px;
    }

    .course-desc,
    .course-info {
      margin: 0;
      font-size: 0.9rem;
      color: black;
    }

    .badge-poin-hijau {
      background-color: #98fb98;
      color: white;
    }

    .badge-poin-kuning {
      background-color: #ffdd32;
      color: white;
    }

    .badge-poin-merah {
      background-color: #ed2939;
      color: white;
    }

    .d-flex.gap-2>.btn {
      flex: 1;
    }

    .btn-form-action {
      background-color: #aee3e0;
      color: #2c6a74;
      border: none;
      border-radius: 25px;
      padding: 8px 25px;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .btn-form-action:hover {
      background-color: #97d7d3;
      color: #2c6a74;
    }

    .text-danger {
      color: #dc3545 !important;
    }

    .btn-primary {
      background-color: #007bff !important;
      border-color: #007bff !important;
      color: #fff !important;
    }

    .btn-primary:hover {
      background-color: #0069d9 !important;
      border-color: #0062cc !important;
    }

    .btn-primary:focus,
    .btn-primary:active {
      background-color: #005cbf !important;
      border-color: #0056b3 !important;
      box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5) !important;
    }

    .form-check-label {
      font-size: 0.85rem;
      color: black;
    }

    .form-check-input {
      margin-right: 8px;
    }

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

    .tindak-lanjut-info {
      margin-top: 10px;
      padding: 8px 12px;
      background-color: #ffffff;
      border-left: 4px solid #2C6A74;
      border-radius: 6px;
      font-size: 0.9rem;
      color: #2c2c2c;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tindak-lanjut-info strong {
      color: #2C6A74;
    }

    #filter-tindak-lanjut {
      max-width: 400px;
    }

    #filter-tindak-lanjut:focus {
      outline: none;
      box-shadow: 0 0 5px rgba(93, 169, 176, 0.5);
    }

    .form-group label {
      font-weight: 600;
      font-size: 15px;
      color: #344767;
      margin-bottom: 6px;
    }

    #filter-tindak-lanjut {
      background-color: #2C6A74;
      background-position: right 10px center;
      background-size: 16px;
      padding-right: 32px;
      padding-left: 20px;
      appearance: none;
      color: white;
    }

    .p-5 {
      padding: 3rem !important;
    }

    .custom-modal {
      background-color: #2c6a74;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(44, 106, 116, 0.3);
      border: none;
      overflow: hidden;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .custom-modal-header {
      background: linear-gradient(135deg, #2c6a74, #5da9b0);
      color: #d0efef;
      border-bottom: none;
      padding: 1.25rem 1.5rem;
      font-weight: 700;
      font-size: 1.25rem;
      align-items: center;
    }

    .custom-modal-header .btn-close {
      filter: brightness(0) invert(1);
      opacity: 0.85;
      transition: opacity 0.2s ease-in-out;
    }

    .custom-modal-header .btn-close:hover {
      opacity: 1;
    }

    .custom-modal-body {
      padding: 1.5rem;
      background-color: #d0efef;
      color: #2c6a74;
    }

    .custom-label {
      font-weight: 600;
      margin-bottom: 0.4rem;
      color: #2c6a74;
    }

    .custom-input {
      width: 100%;
      padding: 0.6rem 1rem;
      border-radius: 12px;
      border: 2px solid #5da9b0;
      font-size: 1rem;
      transition: border-color 0.3s ease;
      color: #2c6a74;
      background-color: #aee3e0;
    }

    .custom-input::placeholder {
      color: #2c6a74aa;
    }

    .custom-input:focus {
      border-color: #2c6a74;
      outline: none;
      box-shadow: 0 0 8px rgba(44, 106, 116, 0.4);
      background-color: #d0efef;
    }

    .custom-modal-footer {
      background-color: #aee3e0;
      border-top: none;
      padding: 1rem 1.5rem;
      display: flex;
      justify-content: flex-end;
      gap: 0.8rem;
    }

    .btn-cancel,
    .btn-export {
      border-radius: 12px;
      padding: 0.5rem 1.4rem;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      border: none;
      color: #fff;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-cancel {
      background-color: #5da9b0;
      color: #d0efef;
    }

    .btn-cancel:hover {
      background-color: #2c6a74;
      color: #aee3e0;
    }

    .btn-export {
      background: linear-gradient(135deg, #2c6a74, #5da9b0);
      box-shadow: 0 4px 12px rgba(44, 106, 116, 0.4);
    }

    .btn-export:hover {
      background: linear-gradient(135deg, #5da9b0, #2c6a74);
      box-shadow: 0 6px 16px rgba(44, 106, 116, 0.6);
    }

    .search-box {
      position: relative;
      width: 100%;
      max-width: 400px;
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

    .floating-alert {
      position: fixed;
      top: 20px;
      right: 20px;
      background: linear-gradient(135deg, #28a745, #5dd078);
      color: #fff;
      padding: 12px 18px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      font-weight: 500;
      z-index: 99999;
      display: flex;
      align-items: center;
      gap: 8px;
      animation: slideIn 0.4s ease, fadeOut 0.5s ease forwards;
    }

    .floating-alert i {
      font-size: 18px;
    }

    .floating-alert.hide {
      opacity: 0;
      transform: translateX(120%);
      transition: all 0.5s ease;
    }

    @keyframes slideIn {
      from {
        transform: translateX(120%);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .ui-autocomplete {
      z-index: 1051 !important; 
    }

    .siswa-dikeluarkan .course-card {
  background-color: #f8d7da !important;
  border: 2px solid #dc3545 !important;
  color: #721c24 !important;
}

  </style>

  <div class="container-fluid py-4">
    <h4 class="mb-4">Revisi Poin Siswa</h4>
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="filter-tindak-lanjut"><strong>Filter Tindak Lanjut:</strong></label>
            <select id="filter-tindak-lanjut" class="form-control" onchange="filterTindakLanjut()">
              <option value="semua">Semua</option>
              <option value="Pengarahan Tim Tatib">Pengarahan Tim Tatib</option>
              <option value="Peringatan ke I (Petugas Ketertiban)">Peringatan ke I (Petugas Ketertiban)</option>
              <option value="Peringatan ke II (Koordinator Ketertiban)">Peringatan ke II (Koordinator Ketertiban)</option>
              <option value="Panggilan Orang Tua ke I + Form Treatment">Panggilan Orang Tua ke I + Form Treatment</option>
              <option value="Panggilan Orang Tua ke II + Surat Peringatan I">Panggilan Orang Tua ke II + Surat Peringatan I</option>
              <option value="Panggilan Orang Tua ke III + Surat Peringatan II">Panggilan Orang Tua ke III + Surat Peringatan II</option>
              <option value="Panggilan Orang Tua ke IV + Surat Peringatan III">Panggilan Orang Tua ke IV + Surat Peringatan III</option>
              <option value="Skorsing (Waka Kesiswaan)">Skorsing (Waka Kesiswaan)</option>
              <option value="Dikembalikan ke Orang Tua (Kepala Sekolah)">Dikembalikan ke Orang Tua (Kepala Sekolah)</option>
            </select>
          </div>

          <div class="col-md-6 d-flex flex-column align-items-end mt-4">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="search-global"
              placeholder="Cari nama, kelas, wali kelas, NISN, keterangan..."
              oninput="this.value = this.value.toUpperCase();">
          </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-start mt-3">
      <div>
        <button class="btn btn-primary" onclick="exportPDF()">
          <i class="fas fa-file-pdf"></i> Export PDF sesuai Filter
        </button>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
          <i class="fas fa-file-pdf"></i> Export PDF Per Siswa
        </button>
      </div>
      <form action="<?= base_url('revisi/simpan') ?>" method="post">
      <div>
        <button type="submit" class="btn btn-success">Simpan Revisi</button>
      </div>
    </div>

    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">

          <div class="modal-header custom-modal-header">
            <h5 class="modal-title" id="exportModalLabel">Laporan Revisi Per Siswa</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body custom-modal-body">
            <label for="namaSiswa" class="form-label custom-label">Cari Siswa</label>
            <input type="text" id="namaSiswa" 
            class="form-control custom-input"
            placeholder="Ketik nama siswa..."
            autocomplete="off"
            oninput="this.value = this.value.toUpperCase();">
            
          <datalist id="siswaList">
            <?php foreach($revisi as $item): ?>
              <option value="<?= $item['nama_siswa'] ?>" 
                      data-nisn="<?= $item['nisn'] ?>">
                <?= $item['nama_siswa'] ?> (<?= $item['kelas'] ?>) - <?= $item['nisn'] ?>
              </option>
            <?php endforeach; ?>
          </datalist>
            <input type="hidden" id="nisnSiswa">
          </div>

          <div class="modal-footer custom-modal-footer">
            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-export" onclick="goExportPDF()">Export PDF</button>
          </div>
        </div>
      </div>
    </div>

      <?php if (empty($revisi)): ?>
        <div class="text-center p-5">
          <h4 class="text-danger">Data Siswa Kosong</h4>
          <p>Masukkan Data Siswa terlebih dahulu untuk mengelola data revisi.</p>
          <a href="<?= base_url('data_siswa') ?>" class="btn btn-primary mt-3">
            <i class="fas fa-user-plus"></i> Input Data Siswa
          </a>
        </div>
      <?php else: ?>

        <div class="timeline">
  <?php foreach ($revisi as $index => $item): ?>
    <?php
      $badgeClass = '';
      if ($item['poin'] <= 55) {
        $badgeClass = 'badge-poin-hijau';
      } elseif ($item['poin'] <= 150) {
        $badgeClass = 'badge-poin-kuning';
      } else {
        $badgeClass = 'badge-poin-merah';
      }

      $poin = $item['poin'];
      $tindakLanjut = '';
      if ($poin >= 0 && $poin <= 10) {
        $tindakLanjut = 'Pengarahan Tim Tatib';
      } elseif ($poin >= 11 && $poin <= 35) {
        $tindakLanjut = 'Peringatan ke I (Petugas Ketertiban)';
      } elseif ($poin >= 36 && $poin <= 55) {
        $tindakLanjut = 'Peringatan ke II (Koordinator Ketertiban)';
      } elseif ($poin >= 56 && $poin <= 75) {
        $tindakLanjut = 'Panggilan Orang Tua ke I + Form Treatment';
      } elseif ($poin >= 76 && $poin <= 100) {
        $tindakLanjut = 'Panggilan Orang Tua ke II + Surat Peringatan I';
      } elseif ($poin >= 101 && $poin <= 150) {
        $tindakLanjut = 'Panggilan Orang Tua ke III + Surat Peringatan II';
      } elseif ($poin >= 151 && $poin <= 200) {
        $tindakLanjut = 'Panggilan Orang Tua ke IV + Surat Peringatan III';
      } elseif ($poin >= 201 && $poin <= 249) {
        $tindakLanjut = 'Skorsing (Waka Kesiswaan)';
      } else {
        $tindakLanjut = 'Dikembalikan ke Orang Tua (Kepala Sekolah)';
      }
    ?>

    <div class="timeline-item <?= isset($item['status']) && $item['status'] == 'dikeluarkan' ? 'siswa-dikeluarkan' : '' ?>"
        data-tindak="<?= $tindakLanjut ?>">
      <div class="timeline-line"></div>
      <div class="card course-card">
        <div class="card-body">
          <h6 class="course-title"><?= $item['nama_siswa'] ?> — <?= $item['kelas'] ?></h6>
          <p class="course-desc">NISN: <?= $item['nisn'] ?></p>
          <p class="course-info">Wali Kelas: <?= $item['wali_kelas'] ?></p>

          <?php if (isset($item['status']) && $item['status'] == 'dikeluarkan'): ?>
            <p class="text-danger fw-bold">
              ⚠️ Siswa sudah dikeluarkan pada 
              <?= !empty($item['tanggal_keluar']) ? date('d-m-Y', strtotime($item['tanggal_keluar'])) : '-' ?>
            </p>
          <?php else: ?>
            <span class="badge badge-info">Aktif</span>

            <span class="badge <?= $badgeClass ?>" id="badge-poin-<?= $index ?>" data-poin="<?= $item['poin'] ?>">
              POIN: <span id="poin-value-<?= $index ?>"><?= $item['poin'] ?></span>
            </span>

            <button type="button" class="btn custom-btn btn-sm" onclick="showDetailPelanggaran(<?= $index ?>)">
              Detail
            </button>

            <p class="tindak-lanjut-info" id="tindak-lanjut-<?= $index ?>">
              <strong>Tindak Lanjut:</strong> <?= $tindakLanjut ?>
            </p>

            <div class="mt-3">
              <div class="form-check">
                <?php if ($item['poin'] >= 250): ?>
                  <span class="text-danger fw-bold small">
                    Siswa sudah mencapai batas poin, dikembalikan ke orang tua
                  </span>
                <?php else: ?>
                  <input class="form-check-input" type="checkbox"
                         name="treatment_checked[]"
                         value="<?= $item['nisn'] ?>"
                         id="treatment1_<?= $item['nisn'] ?>"
                         onchange="updatePoin(<?= $index ?>, '<?= $item['nisn'] ?>')">
                  <label class="form-check-label" for="treatment1_<?= $item['nisn'] ?>">
                    Telah menyelesaikan treatment
                  </label>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?> <!-- ini nutup if status -->
          
          <!-- hidden input supaya bisa ikut ke POST -->
          <input type="hidden" name="revisi[<?= $index ?>][nisn]" value="<?= $item['nisn'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][nama_siswa]" value="<?= $item['nama_siswa'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][kelas]" value="<?= $item['kelas'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][wali_kelas]" value="<?= $item['wali_kelas'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][tanggal]" value="<?= $item['tanggal'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][jenis_data]" value="<?= $item['jenis_data'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][keterangan]" value="<?= $item['keterangan'] ?>">
          <input type="hidden" name="revisi[<?= $index ?>][poin]" id="poin_akhir_<?= $index ?>" value="<?= $item['poin'] ?>">
          <!-- tambahan hidden input -->
          <input type="hidden" name="nisn[]" value="<?= $item['nisn'] ?>">
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</form>
<?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success mt-3">
            <?= $this->session->flashdata('success') ?>
          </div>
          <script>
            <?php foreach ($revisi as $index => $item): ?>
              localStorage.removeItem("treatment_state_<?= $index ?>");
            <?php endforeach; ?>
          </script>
        <?php endif; ?>

        <div id="modal-detail" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">
          <div style="background:white; border-radius:10px; max-width:500px; margin:60px auto; padding:20px; position:relative;">
            <h5>Detail Pelanggaran</h5>
            <ul id="detail-list" style="padding-left:20px;"></ul>
            <button onclick="closeModalDetail()" style="position:absolute; top:10px; right:10px;" class="btn btn-sm btn-danger">X</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const siswaData = <?= json_encode($revisi); ?>; 

      document.getElementById("namaSiswa").addEventListener("input", function() {
      const inputVal = this.value.trim();
      const options = document.querySelectorAll("#siswaList option");
      let nisn = "";

      options.forEach(opt => {
        if (opt.value.toUpperCase() === inputVal.toUpperCase()) {
          nisn = opt.dataset.nisn; // ambil nisn dari data attribute
        }
      });

      document.getElementById("nisnSiswa").value = nisn;
    });

    function goExportPDF() {
        const nisn = $("#nisnSiswa").val();

        if (nisn === "") {
            alert("Harap pilih siswa dari daftar!");
            return;
        }

        window.open("<?= base_url('revisi/export_pdf_per_siswa') ?>?nisn=" + encodeURIComponent(nisn), "_blank");

        // reset
        $("#namaSiswa").val("");
        $("#nisnSiswa").val("");
    }
  </script>

  <script>
    function exportPDF() {
        const selected = document.getElementById('filter-tindak-lanjut').value;
        window.open('<?= base_url("revisi/export_pdf") ?>?tindak=' + encodeURIComponent(selected), '_blank');
    }
  </script>

  <script>
    $(function() {
      $("#namaSiswa").autocomplete({
          source: "<?= base_url('revisi/search_siswa') ?>",
          minLength: 2,
          select: function(event, ui) {
              // isi input nama
              $("#namaSiswa").val(ui.item.value); 
              // simpan NISN ke hidden field (biar validasi lolos)
              $("#nisnSiswa").val(ui.item.nisn);
              return false;
          }
      });
    });

    function getTindakLanjut(poin) {
      if (poin >= 0 && poin <= 10) {
        return 'Pengarahan Tim Tatib';
      } else if (poin >= 11 && poin <= 35) {
        return 'Peringatan ke I (Petugas Ketertiban)';
      } else if (poin >= 36 && poin <= 55) {
        return 'Peringatan ke II (Koordinator Ketertiban)';
      } else if (poin >= 56 && poin <= 75) {
        return 'Panggilan Orang Tua ke I + Form Treatment';
      } else if (poin >= 76 && poin <= 100) {
        return 'Panggilan Orang Tua ke II + Surat Peringatan I';
      } else if (poin >= 101 && poin <= 150) {
        return 'Panggilan Orang Tua ke III + Surat Peringatan II';
      } else if (poin >= 151 && poin <= 200) {
        return 'Panggilan Orang Tua ke IV + Surat Peringatan III';
      } else if (poin >= 201 && poin <= 249) {
        return 'Skorsing (Waka Kesiswaan)';
      } else {
        return 'Dikembalikan ke Orang Tua (Kepala Sekolah)';
      }
    }

    function updatePoin(index, nisn) {
      const poinBadge = document.getElementById(`badge-poin-${index}`);
      const poinValueSpan = document.getElementById(`poin-value-${index}`);
      const initialPoin = parseInt(poinBadge.getAttribute('data-poin'));

      const checkbox = document.getElementById(`treatment1_${nisn}`);
      if (!checkbox) return; // kalau tidak ada checkbox, stop

      const isChecked = checkbox.checked;
      const newPoin = initialPoin - (isChecked ? 30 : 0);
      const finalPoin = newPoin < 0 ? 0 : newPoin;

      poinValueSpan.textContent = finalPoin;
      document.getElementById(`poin_akhir_${index}`).value = finalPoin;

      // update tindak lanjut
      const tindakLanjutText = getTindakLanjut(finalPoin);
      document.getElementById(`tindak-lanjut-${index}`).innerHTML = `<strong>Tindak Lanjut:</strong> ${tindakLanjutText}`;

      // update badge warna
      const badge = document.getElementById(`badge-poin-${index}`);
      badge.classList.remove('badge-poin-hijau', 'badge-poin-kuning', 'badge-poin-merah');
      if (finalPoin <= 55) {
        badge.classList.add('badge-poin-hijau');
      } else if (finalPoin <= 150) {
        badge.classList.add('badge-poin-kuning');
      } else {
        badge.classList.add('badge-poin-merah');
      }

      // kalau poin >= 250, checkbox hilang + tampilkan teks
      if (finalPoin >= 250) {
        checkbox.parentElement.innerHTML = `<p class="text-danger fw-bold">
          Siswa sudah mencapai batas poin, dikembalikan ke orang tua
        </p>`;
      }

      saveCheckboxState(index);
    }

    function saveCheckboxState(index) {
      const checkbox = document.getElementById(`treatment1_${index}`);
      const state = {
        checked: checkbox.checked
      };
      localStorage.setItem(`treatment_state_${index}`, JSON.stringify(state));
    }

    window.onload = function() {
      // <?php foreach ($revisi as $index => $item): ?>

      // <?php endforeach; ?>
      filterTindakLanjut();
    };

    const pelanggaranDetail = <?= json_encode(array_map(function ($item) {
                                return $item['pelanggaran'];
                              }, $revisi)); ?>;

    const detailData = <?= json_encode(array_map(function ($item) {
                          return [
                            'pelanggaran' => $item['pelanggaran'],
                            'kehadiran' => $item['kehadiran']
                          ];
                        }, $revisi)); ?>;

    function showDetailPelanggaran(index) {
      const data = detailData[index];
      let listHTML = '';

      if (data.pelanggaran.length > 0) {
        listHTML += '<strong>Pelanggaran:</strong><ul>';
        data.pelanggaran.forEach(p => {
          listHTML += `<li>${p.jenis} — ${p.poin} poin</li>`;
        });
        listHTML += '</ul>';
      }

      if (data.kehadiran.length > 0) {
        listHTML += '<strong>Kehadiran :</strong><ul>';
        data.kehadiran.forEach(k => {
          listHTML += `<li>${k.jenis} — ${k.poin} poin</li>`;
        });
        listHTML += '</ul>';
      }

      const treatmentCount = revisiData[index].treatment_count || 0;
      listHTML += `<p><strong>Jumlah Treatment Selesai:</strong> ${treatmentCount} kali</p>`;

      document.getElementById('detail-list').innerHTML = listHTML;
      document.getElementById('modal-detail').style.display = 'block';
    }

    function closeModalDetail() {
      document.getElementById('modal-detail').style.display = 'none';
    }

    document.getElementById('search-global').addEventListener('keyup', function () {
      filterTindakLanjut();
    });

    function filterTindakLanjut() {
      const selected = document.getElementById('filter-tindak-lanjut').value.toLowerCase();
      const searchTerm = document.getElementById('search-global').value.toLowerCase();
      const items = document.querySelectorAll('.timeline-item');

      items.forEach(item => {
          const tindak = item.getAttribute('data-tindak').toLowerCase();
          const textContent = item.textContent.toLowerCase();

          const matchFilter = (selected === 'semua' || tindak === selected);
          const matchSearch = textContent.includes(searchTerm);

          if (matchFilter && matchSearch) {
              item.style.display = 'block';
          } else {
              item.style.display = 'none';
          }
      });
    }
  </script>