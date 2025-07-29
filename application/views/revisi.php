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

  .timeline:before {
    content: none !important;
  }

  .course-card {
    border-radius: 12px;
    padding: 20px;
    background-color: #aee3e0;
    /* Card background tetap */
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
  appearance: none; /* remove default arrow */
  color: white;
}


</style>

<div class="container-fluid py-4">
  <h4 class="mb-4">Revisi Poin Siswa</h4>

  <div class="card">
    <div class="card-body">

      <div class="form-group mb-3">
        <label for="filter-tindak-lanjut" ><strong>Filter Tindak Lanjut:</strong></label>
        <select id="filter-tindak-lanjut" class="form-control " onchange="filterTindakLanjut()">
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


      <form action="<?= base_url('revisi/simpan') ?>" method="post">
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

            // Keterangan Tindak Lanjut
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
            } else { // 250 ke atas
              $tindakLanjut = 'Dikembalikan ke Orang Tua (Kepala Sekolah)';
            }

            // Kategori Pelanggaran
            // $kategori = '';
            // if ($poin >= 0 && $poin <= 10) {
            //   $kategori = 'Pelanggaran Sangat Ringan';
            // } elseif ($poin >= 11 && $poin <= 55) {
            //   $kategori = 'Pelanggaran Ringan';
            // } elseif ($poin >= 56 && $poin <= 150) {
            //   $kategori = 'Pelanggaran Sedang';
            // } else {
            //   $kategori = 'Pelanggaran Berat';
            // }

            ?>
            <div class="timeline-item" data-tindak="<?= $tindakLanjut ?>">
              <div class="timeline-line"></div>
              <div class="card course-card">
                <div class="card-body">
                  <h6 class="course-title"><?= $item['nama_siswa'] ?> — <?= $item['kelas'] ?></h6>
                  <p class="course-desc">NISN: <?= $item['nisn'] ?></p>
                  <p class="course-info">Wali Kelas: <?= $item['wali_kelas'] ?></p>
                  <?php if (!empty($item['catatan'])): ?>
                    <p class="course-info">Catatan: <?= $item['catatan'] ?></p>
                  <?php endif; ?>

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
                      <input class="form-check-input" type="checkbox" id="treatment1_<?= $index ?>" onchange="updatePoin(<?= $index ?>)">
                      <label class="form-check-label" for="treatment1_<?= $index ?>">
                        Telah menyelesaikan treatment 1
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="treatment2_<?= $index ?>" onchange="updatePoin(<?= $index ?>)">
                      <label class="form-check-label" for="treatment2_<?= $index ?>">
                        Telah menyelesaikan treatment 2
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="treatment3_<?= $index ?>" onchange="updatePoin(<?= $index ?>)">
                      <label class="form-check-label" for="treatment3_<?= $index ?>">
                        Telah menyelesaikan treatment 3
                      </label>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </form>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success mt-3">
          <?= $this->session->flashdata('success') ?>
        </div>
      <?php endif; ?>

      <!-- MODAL DETAIL PELANGGARAN -->
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


  function updatePoin(index) {
  const poinBadge = document.getElementById(`badge-poin-${index}`);
  const poinValueSpan = document.getElementById(`poin-value-${index}`);
  const initialPoin = parseInt(poinBadge.getAttribute('data-poin'));

  let totalChecked = 0;
  for (let i = 1; i <= 3; i++) {
    const checkbox = document.getElementById(`treatment${i}_${index}`);
    if (checkbox && checkbox.checked) {
      totalChecked++;
    }
  }

  const newPoin = initialPoin - (30 * totalChecked);
  poinValueSpan.textContent = newPoin < 0 ? 0 : newPoin;

  const tindakLanjutText = getTindakLanjut(newPoin < 0 ? 0 : newPoin);
  document.getElementById(`tindak-lanjut-${index}`).innerHTML = `<strong>Tindak Lanjut:</strong> ${tindakLanjutText}`;

  saveCheckboxState(index);
}

function saveCheckboxState(index) {
  let state = {};
  for (let i = 1; i <= 3; i++) {
    const checkbox = document.getElementById(`treatment${i}_${index}`);
    state[`treatment${i}`] = checkbox.checked;
  }
  localStorage.setItem(`treatment_state_${index}`, JSON.stringify(state));
}

function loadCheckboxState(index) {
  const saved = localStorage.getItem(`treatment_state_${index}`);
  if (saved) {
    const state = JSON.parse(saved);
    for (let i = 1; i <= 3; i++) {
      const checkbox = document.getElementById(`treatment${i}_${index}`);
      checkbox.checked = !!state[`treatment${i}`];
    }
    updatePoin(index);
  }
}

  // Saat halaman load, muat semua state checklist
  window.onload = function() {
    const totalSiswa = <?= count($revisi); ?>;
    for (let i = 0; i < totalSiswa; i++) {
      loadCheckboxState(i);
    }

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

    document.getElementById('detail-list').innerHTML = listHTML;
    document.getElementById('modal-detail').style.display = 'block';
  }

  function closeModalDetail() {
    document.getElementById('modal-detail').style.display = 'none';
  }

  function filterTindakLanjut() {
  const selected = document.getElementById('filter-tindak-lanjut').value;
  const items = document.querySelectorAll('.timeline-item');

  items.forEach(item => {
    const tindak = item.getAttribute('data-tindak');
    if (selected === 'semua' || tindak === selected) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

</script>