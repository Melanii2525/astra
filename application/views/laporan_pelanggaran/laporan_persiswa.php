<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran Per Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { text-align: center; margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #2C6A74; color: white; text-align: center; }
        td { vertical-align: top; text-align: center; }
        .total-poin {
            margin-top: 10px;
            font-weight: bold;
            font-size: 14px;
            text-align: right;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: right;
            color: #555;
        }
    </style>
</head>
<body>

<h3>Laporan Pelanggaran Siswa</h3>
<p>Nama: <?= isset($siswa->nama_siswa) ? $siswa->nama_siswa : '-' ?></p>
<p>NISN: <?= isset($siswa->nisn) ? $siswa->nisn : '-' ?></p>
<p>Kelas: <?= isset($siswa->kelas) ? $siswa->kelas : '-' ?></p>

<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Kode</th>
            <th>Poin</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total_poin = 0;
        if (!empty($pelanggaran)):
            $no = 1;
            foreach ($pelanggaran as $p):
                $poin = isset($p->poin) ? (int)$p->poin : 0;
                $total_poin += $poin;
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= isset($p->tanggal) ? date('d-m-Y', strtotime($p->tanggal)) : '-' ?></td>
            <td><?= isset($p->keterangan) ? $p->keterangan : '-' ?></td>
            <td><?= isset($p->kode) ? $p->kode : '-' ?></td>
            <td><?= $poin > 0 ? $poin : '-' ?></td>
        </tr>
        <?php 
            endforeach;
        else:
        ?>
        <tr>
            <td colspan="5" style="text-align:center;">Tidak ada data pelanggaran</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if (!empty($pelanggaran)): ?>
    <div class="total-poin">
        Total Poin: <?= $total_poin ?>
    </div>
<?php endif; ?>

<div class="footer">
    Dicetak pada: <?= date('d-m-Y H:i:s') ?>
</div>

</body>
</html>
