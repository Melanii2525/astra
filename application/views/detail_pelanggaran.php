<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pelanggaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-title a {
            color: #AEE3E0;
            font-size: 22px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .detail-title a:hover {
            color: white;
        }

        .detail-box p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .row-detail > div {
            padding-right: 20px;
        }

        .custom-line {
            border: none;
            height: 3px;
            background-color: #AEE3E0;
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="detail-box">
            <div class="detail-title">
                <a href="<?= base_url('index.php/pelanggaran') ?>">
                    <i class="bi bi-caret-left-fill"></i>
                </a>
                Detail Pelanggaran Siswa
            </div>
            <hr class="custom-line">

            <div class="row row-detail">
                <div class="col-md-4 text-center">
                    <?php if (!empty($data->foto)): ?>
                        <img src="<?= base_url('uploads/foto_siswa/' . $data->foto) ?>" 
                            alt="Foto Siswa" 
                            class="img-fluid rounded mb-3" 
                            style="max-height: 220px; object-fit: cover; border: 3px solid #AEE3E0;">
                    <?php else: ?>
                        <img src="<?= base_url('uploads/foto_siswa/default.png') ?>" 
                            alt="Foto Siswa" 
                            class="img-fluid rounded mb-3" 
                            style="max-height: 220px; object-fit: cover; border: 3px solid #AEE3E0;">
                        <p class="text-light">Foto belum tersedia</p>
                    <?php endif; ?>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>NISN:</strong> <?= $data->nisn ?></p>
                            <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($data->tanggal)) ?></p>
                            <p><strong>Nama:</strong> <?= $data->nama_siswa ?></p>
                            <p><strong>Jenis Kelamin:</strong> <?= $data->jenis_kelamin ?></p>
                            <p><strong>Kelas:</strong> <?= $data->kelas ?></p>
                            <p><strong>Wali Kelas:</strong> <?= $data->wali_kelas ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Kode:</strong> <?= $data->kode ?></p>
                            <p><strong>Jenis Pelanggaran:</strong> <?= $data->keterangan ?></p>
                            <p><strong>Poin:</strong> <?= $data->poin ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>