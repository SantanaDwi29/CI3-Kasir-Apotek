<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nota Pembelian</title>
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
            border-bottom: 1px solid #ddd;
        }

        td {
            text-align: center;
        }

        .total {
            margin-top: 15px;
            text-align: right;
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
        <p>No. Transaksi: <?= isset($transaksi->NoTransaksi) ? $transaksi->NoTransaksi : '-' ?></p>
        <p>Tanggal: <?= date('d/m/Y H:i:s', strtotime($transaksi->TanggalTransaksi)) ?></p>
        <p><?php echo $this->session->userdata("Level"); ?> -
            <?php echo $this->session->userdata("Username"); ?>
        </p>

    </div>

    <?php if (isset($transaksi->idResep) && $transaksi->idResep): ?>
        <div class="info">
            <div class="dotted-line"></div>
            <p>Nama Dokter: <?= isset($transaksi->NamaDokter) ? $transaksi->NamaDokter : '-' ?></p>
            <p>Nama Pasien: <?= isset($transaksi->NamaPelanggan) ? $transaksi->NamaPelanggan : '-' ?></p>
            <p>Alamat Pasien: <?= isset($transaksi->AlamatPelanggan) ? $transaksi->AlamatPelanggan : '-' ?></p>
            <div class="dotted-line"></div>
        </div>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Item</th>
                <th>Jumlah Di Beli</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $items = $this->TransaksiModel->get_transactions_by_group($transaksi->NoTransaksi);
            foreach ($items as $item): ?>
                <tr>
                    <td><?= $item->KodeObat ?></td>
                    <td><?= $item->NamaObat ?></td>
                    <td><?= $item->JumlahDibeli ?></td>
                    <td>Rp <?= number_format($item->HargaSatuan, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($item->JumlahDibeli * $item->HargaSatuan, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        <?php
        $total = 0;
        $items = $this->TransaksiModel->get_transactions_by_group($transaksi->NoTransaksi);
        foreach ($items as $item):
            $total += $item->JumlahDibeli * $item->HargaSatuan;
        endforeach;
        ?>
        <p>Total : Rp <?= number_format($total, 0, ',', '.') ?></p>
        <p>Tunai : Rp <?= number_format($transaksi->JumlahBayar, 0, ',', '.') ?></p>
        <p>Kembali: Rp <?= number_format($transaksi->Kembalian, 0, ',', '.') ?></p>
    </div>

    <div class="footer">
        <div class="dotted-line"></div>
        <p>Terima Kasih Atas Kunjungan Anda</p>
        <p>Semoga Lekas Sembuh</p>
    </div>
</body>

</html>