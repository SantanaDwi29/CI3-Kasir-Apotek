<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 space-y-6">
        <div class="border-b border-gray-200 pb-6">
            <div class="flex items-center space-x-4">
                <div class="p-3 rounded-lg">
                    <i class="fas fa-file-alt text-2xl text-blue-600 "></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Laporan Transaksi</h1>
                    <p class="text-gray-600 mt-1">Periode: <?= $bulan ?>/<?= $tahun ?></p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl">
            <form action="<?= base_url('laporanTransaksi') ?>" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan</label>
                    <select name="bulan" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <?php
                        $bulan_list = [
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
                        foreach ($bulan_list as $key => $value): ?>
                            <option value="<?= $key ?>" <?= (isset($bulan) && $bulan == $key) ? 'selected' : '' ?>>
                                <?= $value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select name="tahun" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <?php
                        $tahun_sekarang = date('Y');
                        for ($i = $tahun_sekarang - 5; $i <= $tahun_sekarang + 5; $i++): ?>
                            <option value="<?= $i ?>" <?= $tahun == $i ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="md:col-span-2 flex items-end gap-3">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2.5 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>
                    <button type="button"
                        onclick="confirmExport('<?= base_url('laporanTransaksi/cetak_pdf?' . http_build_query(['bulan' => $bulan, 'tahun' => $tahun])) ?>')"
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-file-pdf"></i>
                        <span>Export PDF</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    if (!empty($transaksi)):
                        foreach ($transaksi as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $row->NoTransaksi ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d/m/Y', strtotime($row->TanggalTransaksi)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $row->NamaPelanggan ?$row->NamaPelanggan: 'Umum' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $row->NamaObat ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $row->JumlahDibeli ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp <?= number_format($row->HargaJual, 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp <?= number_format($row->TotalHarga, 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($row->Status == 'Lunas'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Lunas
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <i class="fas fa-inbox text-4xl text-gray-400"></i>
                                    <p>Tidak ada data untuk periode yang dipilih</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-sm font-bold text-gray-900 text-right">Total Nilai Transaksi:</td>
                        <td colspan="2" class="px-6 py-4 text-sm font-bold text-gray-900">
                            Rp <?= number_format($totalNilai, 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<script>
    function confirmExport(exportUrl) {
        if (!document.querySelector('tbody tr')) {
            Swal.fire({
                title: 'Tidak Ada Data',
                text: 'Tidak ada data transaksi untuk diexport pada periode ini',
                icon: 'warning',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        Swal.fire({
            title: 'Export PDF',
            text: 'Apakah anda yakin ingin mengexport data transaksi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Export!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(exportUrl, '_blank');
                Swal.fire(
                    'Berhasil!',
                    'File PDF sedang diexport',
                    'success'
                );
            }
        });
    }
</script>