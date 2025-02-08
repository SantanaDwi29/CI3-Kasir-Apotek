<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
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

        .status-lunas {
            color: green;
        }

        .status-pending {
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
        <h3 style="text-align: center;">LAPORAN TRANSAKSI</h3>
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

    <?php if (empty($transaksi)): ?>
        <div class="error">
            Tidak ada data transaksi untuk ditampilkan.
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total_nilai = 0;
                foreach ($transaksi as $row):
                    $total_nilai += $row->TotalHarga;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->NoTransaksi) ?></td>
                        <td><?= date('d/m/Y', strtotime($row->TanggalTransaksi)) ?></td>
                        <td><?= htmlspecialchars($row->NamaPelanggan ? $row->NamaPelanggan : 'Umum') ?></td>
                        <td><?= htmlspecialchars($row->NamaObat) ?></td>
                        <td><?= htmlspecialchars($row->JumlahDibeli) ?></td>
                        <td>Rp <?= number_format($row->HargaJual, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($row->TotalHarga, 0, ',', '.') ?></td>
                        <td class="<?= $row->Status == 'Lunas' ? 'status-lunas' : 'status-pending' ?>">
                            <?= htmlspecialchars($row->Status) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="text-align: right;"><strong>Total Nilai Transaksi:</strong></td>
                    <td colspan="2"><strong>Rp <?= number_format($total_nilai, 0, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>
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