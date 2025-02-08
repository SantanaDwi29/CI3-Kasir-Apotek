<?php
// $Level = $this->session->userdata('Level');
// if ($Level == 'Admin') {
//     echo 'Admin';
// } else {
//     echo 'Kasir';
// }

$totalStok = 0;
$currentDate = date('Y-m-d');
?>

        <div class="p-6 bg-white shadow-md rounded-lg">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-table text-blue-600 mr-3"></i>
                            Tabel Data Obat
                        </h1>
                        <div class="relative w-full sm:w-64">
                            <input type="text" id="searchInput"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                                placeholder="Cari nama obat...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-auto w-full">
                    <table class="table-auto w-full text-left divide-y divide-gray-200" id="obatTabel">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Foto Obat</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Obat</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Input</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Obat</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemasok</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Obat</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Jual</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Beli</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Expired</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <!-- <?php
                                        $Level = $this->session->userdata('Level');
                                        if ($Level == "Admin") {
                                            echo "Admin";
                                        } else {
                                            echo "Kasir";
                                        }
                                        ?> -->
                                <?php if ($Level == "Admin"): ?>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($obat) && is_array($obat)): ?>
                                <?php foreach ($obat as $index => $item):
                                    $totalStok += $item->StokObat;
                                    $Expired = (strtotime($item->ExpObat) < strtotime($currentDate));
                                    $rowClass = $Expired ? 'bg-red-50 hover:bg-red-100' : 'hover:bg-gray-50';
                                ?>
                                    <tr class="<?= $rowClass ?> transition-all duration-200">
                                        <td class="px-6 py-4 text-sm text-gray-600"><?= $index + 1 ?></td>
                                        <td class="px-6 py-4">
                                            <div class="relative w-20 h-20">
                                                <?php if (!empty($item->FotoObat)): ?>
                                                    <img src="<?= base_url('uploads/obat/' . $item->FotoObat) ?>"
                                                        alt="<?= $item->NamaObat ?>"
                                                        class="absolute inset-0 w-full h-full object-cover rounded-lg">
                                                <?php else: ?>
                                                    <div class="absolute inset-0 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <span class="text-gray-500 text-sm">No Image</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600"><?= $item->KodeObat ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600"><?= htmlspecialchars($item->TanggalMasuk) ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600"><?= htmlspecialchars($item->NamaObat) ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600"><?= htmlspecialchars($item->NamaPemasok) ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600"><?= htmlspecialchars($item->JenisObat) ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600">Rp <?= number_format($item->HargaSatuan, 0, ',', '.') ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600">Rp <?= number_format($item->HargaJual, 0, ',', '.') ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600">Rp <?= number_format($item->HargaBeli, 0, ',', '.') ?></td>
                                        <td class="px-6 py-4  text-sm text-gray-600"><?= $item->StokObat ?></td>
                                        <td class="px-6 py-4  text-sm <?= $Expired ? 'text-red-600 font-semibold' : 'text-gray-600' ?>">
                                            <?= date('d M Y', strtotime($item->ExpObat)) ?>
                                            <?= $Expired ? ' (Expired)' : '' ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($item->Keterangan) ?></td>
                                        <?php if ($Level == "Admin"): ?>
                                            <td class="px-6 py-4  text-sm text-gray-600">
                                                <div class="flex items-center space-x-4">
                                                    <button onclick="editObat(<?= $item->idObat ?>)"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button onclick="deleteObat(<?= $item->idObat ?>)"
                                                        class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                                <!-- Total Row -->
                                <tr class="bg-gray-50 font-semibold">
                                    <td colspan="10" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-right">Total Stok:</td>
                                    <td colspan="<?= ($Level == "Admin" ? "4" : "3") ?>" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <?= $totalStok ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="<?= ($Level == "Admin" ? "12" : "11") ?>" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada data obat
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>