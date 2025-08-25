<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f7f8;
            font-family: 'Poppins', sans-serif;
            padding: 10px;
        }

        .judul {
            text-align: center;
            font-size: 26px;
            font-weight: 600;
            color: #2C6A74;
            margin-bottom: 10px;
        }

        .custom-line {
            border: none;
            height: 3px;
            background-color: #AEE3E0;
            margin: 10px auto 30px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #2C6A74;
            padding: 10px;
            text-align: center;
            font-size: 10px;
        }

        th {
            background-color: #2C6A74;
            color: white;
        }

        td {
            background-color: #f9fdfd;
        }

        .footer {
            text-align: right;
            margin-top: 40px;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="judul">Laporan Pelanggaran Siswa</div>
    <hr class="custom-line">
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NISN</th>
                <th>TANGGAL</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>KELAS</th>
                <th>WALI KELAS</th>
                <th>KODE</th>
                <th>JENIS PELANGGARAN</th>
                <th>POIN</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($pelanggaran as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nisn ?></td>
                <td><?= date('d-m-Y', strtotime($row->tanggal)) ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->jenis_kelamin == 'L' ? 'Laki-laki' : ($row->jenis_kelamin == 'P' ? 'Perempuan' : '-') ?></td>
                <td><?= $row->kelas ?></td>
                <td><?= $row->wali_kelas ?></td>
                <td><?= $row->kode ?></td>
                <td><?= $row->keterangan ?></td>
                <td><?= $row->poin ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

</body>
</html>
