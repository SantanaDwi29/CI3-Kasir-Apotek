<?php
$totalPelanggan = 0;
?>

<div class="p-6 bg-white shadow-md rounded-lg">
    <div class="overflow-x-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-table text-blue-600 mr-3"></i>
                Tabel Resep
            </h1>
            <div class="flex gap-4">
                <div class="relative">
                    <input type="text" id="searchInput"
                        placeholder="Cari resep..."
                        class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <table class="w-full table-auto" id="resepTabel">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama Dokter</th>
                    <th class="py-3 px-6 text-left">Nama Pasien</th>
                    <th class="py-3 px-6 text-left">Alamat Pasien</th>
                    <th class="py-3 px-6 text-left">Tanggal & Waktu</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>

                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <?php if (!empty($resep) && is_array($resep)): ?>
                        <?php foreach ($resep as $index => $item):
                            $totalPelanggan++;
                        ?>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= $index + 1 ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($item->NamaDokter) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($item->NamaPelanggan) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($item->AlamatPelanggan) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($item->TanggalResep) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $item->Status ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-yellow-700 border border-yellow-200' ?>">
                                    <?php if ($item->Status): ?>
                                        <i class="fas fa-check-circle mr-1"></i>Sudah Diproses
                                    <?php else: ?>
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <button onclick="editResep(<?= $item->idResep ?>)"
                                        class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteResep(<?= $item->idResep ?>)"
                                        class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                </tr>
            <?php endforeach; ?>
            <tr class="bg-gray-50">
                <td colspan="2" class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-600 text-right">Total Pasien:</td>
                <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-600"><?= $totalPelanggan ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="9" class="py-
                        3 px-6 text-center">Tidak ada data resep</td>
            </tr>
        <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>