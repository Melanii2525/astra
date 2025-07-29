<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pelanggaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

        .row-detail > div {
            padding-right: 20px;
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
</head>

<body>

<div class="container mt-4">
    <div class="detail-box">
        <div class="detail-title">Detail Pelanggaran Siswa</div>
        <hr class="custom-line">

        <div class="row row-detail">
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

        <a href="<?= base_url('index.php/pelanggaran') ?>" class="btn back-btn">Kembali</a>
    </div>
</div>

</body>
</html>
