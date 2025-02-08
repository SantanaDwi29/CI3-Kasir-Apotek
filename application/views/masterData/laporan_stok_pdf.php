<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Stok Obat</title>
    <link rel="icon" type="image/png" href="image/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 70px;
            height: auto;
            margin: 0 auto 5px;
            display: block;
        }

        h2 {
            margin: 0 0 5px 0;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            margin: 10px 0;
        }

        p {
            margin: 3px 0;
        }

        .status-minimum {
            color: red;
        }

        .status-aman {
            color: green;
        }

        .expired {
            background-color: #ffcccc;
            color: red;
        }

        .error {
            color: red;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid red;
            background-color: #fff;
        }

        .signature-container {
            margin-top: 50px;
            text-align: right;
            /* padding-right: 50px; */
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin-top: 70px;
            margin-bottom: 5px;
        }

        .signature-name {
            font-weight: bold;
        }

        .signature-title {
            font-style: italic;
        }

        .signature-date {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?= base_url('gambar/logo.png') ?>" alt="Logo Apotek" class="logo">
        <h2>APOTEK ASSA FARMA</h2>
        <p>Jl.Tanah Lot No.44, Pandak Gede, Kediri, Tabanan, Bali 82121</p>
        <p>Telp: (021) 555-0123</p>
        <div class="dotted-line"></div>
    </div>

    <div class="info">
        <h3 style="text-align: center;">LAPORAN STOK OBAT</h3>
        <p>Periode: <?php
                    $nama_bulan = [
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember'
                    ];
                    echo $nama_bulan[$bulan] . ' ' . $tahun;
                    ?></p>
        <p><p><?php echo $this->session->userdata("Level"); ?> -
            <?php echo $this->session->userdata("NamaLengkap"); ?>
        </p>
    </div>

    <?php if (empty($obat)): ?>
        <div class="error">
            Tidak ada data obat untuk ditampilkan.
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Kode Obat</th>
                    <th>Foto Obat</th>
                    <th>Nama Obat</th>
                    <th>Nama Pemasok</th>
                    <th>Kategori Obat</th>
                    <th>Stok</th>
                    <th>Harga Satuan</th>
                    <th>Expired</th>
                    <th>Total Nilai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_nilai = 0;
                $today = date('Y-m-d');
                foreach ($obat as $row):
                    $nilai = $row->StokObat * $row->HargaSatuan;
                    $total_nilai += $nilai;
                    $is_expired = strtotime($row->ExpObat) < strtotime($today);
                ?>
                    <tr class="<?= $is_expired ? 'expired' : '' ?>">
                        <td><?= htmlspecialchars($row->KodeObat) ?></td>
                        <td>
                            <?php if (!empty($row->FotoObat)): ?>
                                <img src="<?= base_url('uploads/obat/' . $row->FotoObat) ?>"
                                    alt="<?= $row->NamaObat ?>"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= base_url('uploads/default.jpg') ?>"
                                    alt="No Image"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row->NamaObat) ?></td>
                        <td><?= htmlspecialchars($row->NamaPemasok) ?></td>
                        <td><?= htmlspecialchars($row->JenisObat) ?></td>
                        <td><?= htmlspecialchars($row->StokObat) ?></td>
                        <td>Rp <?= number_format($row->HargaSatuan, 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row->ExpObat) ?></td>
                        <td>Rp <?= number_format($nilai, 0, ',', '.') ?></td>
                        <td class="<?= $is_expired ? 'status-minimum' : ($row->StokObat <= 5 ? 'status-minimum' : 'status-aman') ?>">
                            <?= $is_expired ? 'Expired' : ($row->StokObat <= 5 ? 'Stok Minimum' : 'Stok Aman') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            <p>Total Nilai Inventaris: Rp <?= number_format($total_nilai, 0, ',', '.') ?></p>
        </div>
    <?php endif; ?>

    <div class="signature-container">
        <div class="signature-box">
            <div class="signature-date">
                Tabanan, <?php
                            $nama_bulan = [
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember'
                            ];
                            echo date('d') . ' ' . $nama_bulan[date('m')] . ' ' . date('Y');
                            ?>
            </div>
            <div class="signature-line"></div>
            <div class="signature-name">( <?php echo $this->session->userdata("NamaLengkap"); ?> )</div>
            <div class="signature-title"> <?php echo $this->session->userdata("Level"); ?></div>
        </div>
    </div>

    <div class="footer">
        <div class="dotted-line"></div>
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>
    </div>
</body>

</html>