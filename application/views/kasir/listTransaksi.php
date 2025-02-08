<div class="p-6 bg-white shadow-md rounded-lg ">
    <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fa-solid fa-clock-rotate-left text-blue-600 mr-3"></i>
                Riwayat Transaksi
            </h1>        
            <div class="flex gap-4">
            <div class="relative">
                <input type="text" id="searchInput"
                    placeholder="Cari transaksi..." 
                    class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200" id="tableTransaksi">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Obat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Obat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bayar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kembalian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Resep</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Resep</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($transaksi as $index => $t): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?= date('d/m/Y H:i', strtotime($t->TanggalTransaksi)) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?=$t->KodeObat?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $t->NamaObat ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp <?= number_format($t->TotalHarga, 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp <?= number_format($t->JumlahBayar, 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp <?= number_format($t->Kembalian, 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($t->StatusResep == 1): ?>
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                    Dengan Resep
                                </span>
                            <?php else: ?>
                                <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">
                                    Tanpa Resep
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php if ($t->StatusResep == 1): ?>
                                <div class="text-sm">
                                    <p class="font-medium">Dokter: <?= $t->NamaDokter ?></p>
                                    <p class="text-gray-500">Pasien: <?= $t->NamaPelanggan ?></p>
                                </div>
                            <?php else: ?>
                                <span class="text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                       
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>