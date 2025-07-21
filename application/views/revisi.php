<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
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
  .course-card {
    border-radius: 12px;
    padding: 20px;
    color: #2c6a74;
  }
  .bg-strong-teal {
    background-color: #98fb98; /* Teal solid */
    color: white;
  }

  .bg-strong-yellow {
    background-color: #ffdd32; /* Amber/kuning emas */
    color: #2c2c2c;
  }

  .bg-strong-red {
    background-color: #ed2939; /* Merah tua */
    color: white;
  }

  .course-title {
    font-weight: bold;
    font-size: 1.1rem;
    margin-bottom: 6px;
  }
  .course-desc, .course-info {
    margin: 0;
    font-size: 0.9rem;
    color: black;
  }
  .badge {
    padding: 5px 10px;
    font-size: 0.8rem;
    border-radius: 20px;
    margin-top: 10px;
    display: inline-block;
  }
  .bg-green {
    background-color: #24565d;
    color: white;
  }
  .bg-edit-custom {
    background-color: #aee3e0;
    color: #2c6a74;
  }

  .bg-edit-custom:hover {
    background-color: #97d7d3; 
    color: #2c6a74;
  }

  #form-edit-revisi {
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

#form-edit-revisi .card {
  width: 90%;
  max-width: 500px;
  margin: 50px auto;
  background-color: #2C6A74;
  color: white;
  border-radius: 20px;
  padding: 20px;
}

#form-edit-revisi .card h5 {
  text-align: center;
  font-weight: bold;
  margin-bottom: 25px;
}

#form-edit-revisi .form-group {
  margin-bottom: 15px;
}

#form-edit-revisi label {
  font-size: 14px;
  font-weight: 500;
  color: #ffffff;
  margin-bottom: 5px;
}

#form-edit-revisi .form-control {
  border-radius: 20px;
  background-color: #d3d3d3;
  border: none;
  padding: 10px 15px;
  color: black;
}

#form-edit-revisi .form-control:focus {
  outline: none;
  box-shadow: none;
}

#form-edit-revisi .btn-custom-submit {
  background-color: #AEE3E0;
  color: black;
  border-radius: 25px;
  padding: 8px 25px;
  border: none;
}

#form-edit-revisi .btn-custom-submit:hover {
  background-color: #92c8c4;
  color: white;
}

#form-edit-revisi .btn-secondary {
  background-color: #9dd8d6;
  color: #2c6a74;
  border: none;
  border-radius: 25px;
  padding: 8px 25px;
}
.d-flex.gap-2 > .btn {
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


</style>

<div class="container-fluid py-4">
<h4 class="mb-4">Revisi Poin Siswa</h4>
  <div class="card">
    <div class="card-body">

      <form action="<?= base_url('revisi/simpan') ?>" method="post">
        <div class="timeline">
        <?php foreach ($revisi as $index => $item): ?>
          <?php
            // Tentukan warna latar berdasarkan jumlah poin
            $bgClass = '';
            if ($item['poin'] <= 55) {
                $bgClass = 'bg-strong-teal'; // Hijau muda
            } elseif ($item['poin'] <= 150) {
                $bgClass = 'bg-strong-yellow'; // Kuning muda (akan dibuat di CSS)
            } else {
                $bgClass = 'bg-strong-red'; 
            }
          ?>
          <div class="timeline-item">
            <div class="timeline-line"></div>
            <div class="card course-card <?= $bgClass ?>">
              <div class="card-body">
                <h6 class="course-title"><?= $item['nama'] ?> — <?= $item['kelas'] ?></h6>
                <p class="course-desc">NISN: <?= $item['nisn'] ?></p>
                <p class="course-info">Wali Kelas: <?= $item['wali_kelas'] ?></p>
                <?php if (!empty($item['catatan'])): ?>
                <p class="course-info">Catatan: <?= $item['catatan'] ?></p>
              <?php endif; ?>

                <span class="badge bg-green">
                  POIN: <?= $item['poin'] ?>
                </span>

                <a href="javascript:void(0);" 
                  onclick="editRevisi(
                    '<?= $item['nisn'] ?>',
                    '<?= $item['nama'] ?>',
                    '<?= $item['kelas'] ?>',
                    '<?= $item['wali_kelas'] ?>',
                    '', 
                    '<?= $item['poin'] ?>'
                  )"
                  class="badge bg-edit-custom ms-2 text-decoration-none" 
                  title="Edit Data">
                  <i class="fas fa-edit me-1"></i> Edit
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </form>

 <!-- MODAL FORM EDIT REVISI -->
<div id="form-edit-revisi">
  <div class="card">
    <div class="card-body">
      <h5 class="text-center">FORM EDIT REVISI</h5>
      <p id="pesan-revisi" class="text-danger text-center"></p>

      <form id="formEditRevisi" method="post" action="<?= base_url('revisi/update') ?>">
        <input type="hidden" name="nisn" id="edit-nisn">

        <div class="form-group">
          <label for="edit-nama">Nama:</label>
          <input type="text" name="nama" id="edit-nama" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="edit-kelas">Kelas:</label>
          <input type="text" name="kelas" id="edit-kelas" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="edit-wali_kelas">Wali Kelas:</label>
          <input type="text" name="wali_kelas" id="edit-wali_kelas" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="edit-catatan">Catatan:</label>
          <input type="text" name="catatan" id="edit-catatan" class="form-control">
        </div>

        <div class="form-group">
          <label for="edit-poin">Poin:</label>
          <input type="text" name="poin" id="edit-poin" class="form-control">
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="button" onclick="$('#form-edit-revisi').hide();" class="btn btn-form-action">Batal</button>
          <button type="submit" class="btn btn-form-action">Ubah</button>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
  <!-- <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success mt-3">
      <?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?> -->
</div>
    </div>
  </div>
</div>

    <!-- <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary px-4">Simpan ke tb_revisi</button>
    </div> -->
  </form>



<script>
function editRevisi(nisn, nama, kelas, wali_kelas, catatan, poin) {
    $('#edit-nisn').val(nisn);
    $('#edit-nama').val(nama);
    $('#edit-kelas').val(kelas);
    $('#edit-wali_kelas').val(wali_kelas);
    $('#edit-catatan').val(catatan);
    $('#edit-poin').val(poin);

    $('#form-edit-revisi').show();
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
