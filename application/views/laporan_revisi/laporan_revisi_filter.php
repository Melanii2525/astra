<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h4 { text-align: center; margin-bottom: 20px; }
        .item { 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc; 
            border-radius: 6px; 
            background: #f9f9f9; 
        }
        .badge { 
            padding: 4px 8px; 
            border-radius: 4px; 
            font-size: 11px; 
            font-weight: bold; 
        }
        .badge-hijau { background-color: #98fb98; color: black; }
        .badge-kuning { background-color: #ffdd32; color: black; }
        .badge-merah { background-color: #ed2939; color: white; }
        .label { font-weight: bold; width: 90px; display: inline-block; }
    </style>
</head>

<body>
    <h4>
        Laporan Revisi Poin Siswa
        <?= !empty($filter_tindak_lanjut) && $filter_tindak_lanjut != 'all' ? " - Tindak Lanjut: " . htmlspecialchars($filter_tindak_lanjut) : "" ?>
    </h4>

    <?php foreach ($revisi as $item): ?>
        <?php
            $poin = isset($item['poin']) ? (int)$item['poin'] : 0;

            // Tentukan warna badge normal
            if ($poin <= 55) $badgeClass = 'badge-hijau';
            elseif ($poin <= 150) $badgeClass = 'badge-kuning';
            else $badgeClass = 'badge-merah';

            // Cek apakah sudah mencapai batas poin
            $isBatas = $poin >= 250;
        ?>
        <div class="item" style="<?= $isBatas ? 'border:2px solid #ed2939; background:#ffe5e5;' : '' ?>">
            <div><span class="label">Nama</span>: <?= htmlspecialchars($item['nama_siswa']) ?> (<?= htmlspecialchars($item['kelas']) ?>)</div>
            <div><span class="label">NISN</span>: <?= htmlspecialchars($item['nisn']) ?></div>
            <div><span class="label">Wali Kelas</span>: <?= htmlspecialchars($item['wali_kelas']) ?></div>
            <div><span class="label">Poin</span>: 
                <span class="badge <?= $badgeClass ?>"><?= $poin ?></span>
                <?php if ($isBatas): ?>
                    <span style="color:#ed2939; font-weight:bold; margin-left:8px;">
                        ⚠ Batas poin tercapai
                    </span>
                <?php endif; ?>
            </div>
            <div><span class="label">Tindak Lanjut</span>: 
                <?php if ($isBatas): ?>
                    <span style="color:#ed2939; font-weight:bold;">Tidak bisa treatment</span>
                <?php else: ?>
                    <?= htmlspecialchars($item['tindak_lanjut'] ?? '-') ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>