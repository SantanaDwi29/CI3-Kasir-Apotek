<div class="p-6 bg-white shadow-md rounded-lg ">
    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-table text-blue-600 mr-3"></i>
                        Tabel Kategori Obat
                    </h1>
                </div>
            </div>
            <table class="min-w-full divide-y divide-gray-200" id="jenisObatTabel">
                <thead class="bg-gray-100">
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="y-3 px-6 text-left">Nama Kategori Obat</th>
                        <th class="y-3 px-6 text-left">Keterangan</th>
                        <th class="y-3 px-6 text-left"">Aksi</th>
                    </tr>
                </thead>
                <tbody class=" bg-white divide-y divide-gray-200">
                            <?php if (!empty($jenisObat)): ?>
                                <?php foreach ($jenisObat as $index => $item): ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= $index + 1 ?></td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($item->JenisObat) ?></td>
                        <td class="px-4 py-3 text-sm text-gray-600"><?= htmlspecialchars($item->Keterangan) ?></td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600 text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <button onclick="editJenisObat(<?= $item->idJenisObat ?>)"
                                    class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteJenisObat(<?= $item->idJenisObat ?>)"
                                    class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-600">
                        Tidak ada data kategori obat
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>