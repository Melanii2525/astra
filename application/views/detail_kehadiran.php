<style>
    body {
        background-color: #f3f7f8;
        font-family: 'Poppins', sans-serif;
    }

    .detail-box {
        background-color: #2C6A74;
        padding: 30px;
        border-radius: 15px;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .detail-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .detail-box p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .back-btn {
        margin-top: 30px;
        background-color: #AEE3E0;
        color: #2C6A74;
        font-weight: 600;
        border: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .back-btn:hover {
        background-color: #88c9c5;
        color: white;
    }

    .custom-line {
        border: none;
        height: 3px;
        background-color: #AEE3E0;
        margin-top: 10px;
        margin-bottom: 20px;
    }

</style>

<div class="container mt-4">
    <div class="detail-box">
        <div class="detail-title">Detail Kehadiran Siswa</div>
        <hr class="custom-line">

        <p><strong>NISN:</strong> <?= $data->nisn ?></p>
        <p><strong>Tanggal:</strong> <?= $data->waktu ?></p>
        <p><strong>Nama:</strong> <?= $data->nama ?></p>
        <p><strong>Jenis Kelamin:</strong> <?= $data->jenis_kelamin ?></p>
        <p><strong>Kelas:</strong> <?= $data->kelas ?></p>
        <p><strong>Wali Kelas:</strong> <?= $data->wali_kelas ?></p>
        <p><strong>Keterangan:</strong> <?= $data->keterangan ?></p>

        <a href="<?= base_url('kehadiran') ?>" class="btn back-btn">Kembali</a>
    </div>
</div>

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

<!-- Tambahkan font Poppins jika belum di header -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
