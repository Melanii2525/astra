<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
  html,
  body {
    height: 100%;
    margin: 0;
  }

  body {
    display: flex;
    flex-direction: column;
  }

  .card {
    margin-bottom: 1.5rem;
  }

  .batas-poin {
    background-color: #f8d7da;
    border: 1px solid #f5c2c7;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .batas-poin:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
  }

  /* Ikon tanda seru */
  .batas-poin .icon {
    width: 35px;
    height: 35px;
    background-color: #dc3545;
    /* merah solid */
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
  }

  footer.footer {
    flex-shrink: 0;
  }

  .main-content {
    flex: 1 0 auto;
    padding: 1rem 1rem;
  }

  @media (min-width: 1200px) {
    .main-content {
      margin-left: 270px;
      padding-left: 2rem;
      padding-right: 2rem;
    }
  }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12 p-0">
      <h3 class="mb-3 h4 x">Dashboard</h3>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $this->session->flashdata('success') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $this->session->flashdata('error') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <div class="card p-4 border-0" style="background-color: #D0EFEF; border-radius: 20px;">
        <div class="row align-items-center">
          <div class="col-md-7 col-12 mb-3 mb-md-0">
            <h4 class="fw-bold">Welcome to ASTRA SELAPAN!</h4>
            <p>Catat dan pantau pelanggaran siswa dengan cepat dan efisien melalui sistem tata tertib digital sekolah.</p>
            <button class="btn px-4 py-2 text-white mt-2"
              style="background-color: #2C6A74; border-radius: 30px;"
              onclick="window.location.href='<?= base_url('data_siswa'); ?>'">
              Input Data Siswa
            </button>
          </div>
          <div class="col-md-5 col-12 text-center">
            <img src="<?= base_url('assets/img/maskot.png'); ?>"
              alt="Robot Astra"
              class="img-fluid"
              style="max-height: 200px;">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-lg-8 col-md-7">
      <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body">

          <!-- Section: Siswa sudah mencapai batas poin -->
          <h4 class="mb-3 font-weight-bold text-danger">Telah mencapai batas maksimum poin</h4>
          <?php
          $batasPoinAda = false;
          foreach ($ranking as $row):
            if ($row['poin'] >= 250):
              $batasPoinAda = true;
          ?>
              <div class="d-flex align-items-center p-2 mb-2 rounded batas-poin">
                <div class="icon mr-3">!</div>
                <div class="flex-grow-1">
                  <h6 class="mb-0 font-weight-bold"><?= $row['nama_siswa'] ?></h6>
                  <small class="text-muted"><?= $row['kelas'] ?></small>
                </div>
                <span class="badge badge-danger p-2 mr-2" style="min-width: 60px;">
                  <?= $row['poin'] ?> Poin
                </span>

                <!-- Tombol upload bukti -->
                <button class="btn btn-sm btn-outline-danger uploadBtn" 
                        data-nisn="<?= $row['nisn'] ?>" 
                        data-nama="<?= $row['nama_siswa'] ?>">
                  <i class="fas fa-upload"></i> Upload Bukti
                </button>
              </div>
            <?php
            endif;
          endforeach;

          if (!$batasPoinAda): ?>
            <p class="text-muted">Tidak ada siswa yang mencapai batas poin.</p>
          <?php endif; ?>

          <!-- Section: Siswa dengan poin terbanyak -->
          <h4 class="mt-4 mb-3 font-weight-bold">Siswa dengan poin terbanyak</h4>
          <?php foreach ($ranking as $i => $row): ?>
            <?php if ($row['poin'] >= 250) continue; // skip siswa yg sudah mencapai batas 
            ?>

            <div class="d-flex align-items-center p-2 mb-2 rounded"
              style="background-color: <?= ($i == 0) ? '#FFD70033' : (($i == 1) ? '#C0C0C033' : (($i == 2) ? '#CD7F3233' : '#F8F9FA')); ?>;">

              <!-- Ranking number -->
              <div class="text-center mr-3"
                style="width: 35px; height: 35px; background-color: #2C6A74; color: white; 
                      border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                <?= $i + 1 ?>
              </div>

              <!-- Student info -->
              <div class="flex-grow-1">
                <h6 class="mb-0 font-weight-bold"><?= $row['nama_siswa'] ?></h6>
                <small class="text-muted"><?= $row['kelas'] ?></small>
              </div>

              <!-- Poin badge -->
              <span class="badge 
                <?= ($row['poin'] <= 55) ? 'badge-success' : (($row['poin'] <= 150) ? 'badge-warning' : 'badge-danger') ?> p-2"
                style="min-width: 60px;">
                <?= $row['poin'] ?> Poin
              </span>
            </div>
          <?php endforeach; ?>


        </div>
      </div>
    </div>

    

    <!-- Rekap Siswa -->
    <div class="col-lg-4 col-md-5">
      <div class="row">
        <h4 class="mb-3 font-weight-bold">Rekap Siswa</h4>
        <div class="col-6 mb-3">
          <div class="p-3 rounded shadow-sm text-center" style="background: #EAEFFF;">
            <h4 class="mb-0 font-weight-bold">
              <?= isset($total_pelanggaran_bulan_lalu) ? $total_pelanggaran_bulan_lalu : '0' ?>
            </h4>
            <small class="text-muted">PELANGGARAN BULAN LALU</small>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="p-3 rounded shadow-sm text-center" style="background: #FFEAF4;">
            <h4 class="mb-0 font-weight-bold">
              <?= isset($total_alpha_bulan_lalu) ? $total_alpha_bulan_lalu : '0' ?>
            </h4>
            <small class="text-muted">ALPHA BULAN LALU</small>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 rounded shadow-sm text-center" style="background: #FFF5E0;">
            <h4>
              <?= isset($total_terlambat_hari_ini) ? $total_terlambat_hari_ini : '0' ?>
            </h4>
            <small class="text-muted">TERLAMBAT HARI INI</small>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 rounded shadow-sm text-center" style="background: #FFF4E5;">
            <h4>
              <?= isset($total_siswa_treatment_tahun_ini) ? $total_siswa_treatment_tahun_ini : '0' ?>
            </h4>
            <small class="text-muted">TREATMENT TAHUN INI</small>
          </div>
        </div>
      </div>

      <!-- Section: Log Siswa Dikeluarkan (dipindah ke bawah rekap) -->
<div class="mt-4">
  <h4 class="mb-1 font-weight-bold text-danger">Siswa Dikeluarkan</h4>
  <small class="text-muted d-block mb-3" style="font-size: 0.85rem;">
    *Daftar ini hanya menampilkan siswa yang dikeluarkan dalam 5 bulan terakhir.  
    Setelah lewat 5 bulan, data tidak lagi ditampilkan di dashboard.
  </small>

  <?php if (!empty($log_keluar)): ?>
    <?php foreach ($log_keluar as $row): ?>
      <div class="d-flex align-items-center p-2 mb-2 rounded batas-poin">
        <div class="flex-grow-1">
          <h6 class="mb-0 font-weight-bold"><?= $row['nama_siswa'] ?></h6>
          <small class="text-muted">
            <?= $row['kelas'] ?> - Wali: <?= $row['wali_kelas'] ?>
          </small><br>
          <small class="text-muted">
            Dikeluarkan: <?= date('d-m-Y H:i', strtotime($row['tanggal_keluar'])) ?>
          </small>
        </div>
        <span class="badge badge-dark p-2 mr-2">NISN: <?= $row['nisn'] ?></span>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-muted">Belum ada siswa yang dikeluarkan.</p>
  <?php endif; ?>
</div>

    </div>

  </div>
</div>

      <!-- Input tersembunyi untuk upload -->
<form id="uploadForm" method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/upload_bukti'); ?>">
  <input type="hidden" name="nisn" id="nisn">
  <input type="file" name="bukti" id="bukti" class="d-none" accept=".pdf,.jpg,.png" required>
</form>
 

<script>
  if (document.querySelector('.input-group input')) {
    var inputs = document.querySelectorAll('.input-group input');
    inputs.forEach(input => {
      if (input.value != "") {
        input.parentElement.classList.add("is-filled");
      }

      input.addEventListener("focus", function() {
        input.parentElement.classList.add("is-focused");
      });

      input.addEventListener("blur", function() {
        if (input.value == "") {
          input.parentElement.classList.remove("is-filled");
        }
        input.parentElement.classList.remove("is-focused");
      });
    });
  }
</script>

<script>
  // Klik tombol upload → buka file manager
  $(document).on('click', '.uploadBtn', function () {
    var nisn = $(this).data('nisn');
    $('#nisn').val(nisn);
    $('#bukti').click(); // buka file manager
  });

  // Setelah file dipilih → auto submit
  $('#bukti').on('change', function () {
    if (this.files.length > 0) {
      $('#uploadForm').submit();
    }
  });
</script>