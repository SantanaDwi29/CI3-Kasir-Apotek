<div class="bg-white shadow-md rounded-lg">
        <div class="p-6 border-b flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-users text-blue-600 mr-3"></i>
                Data Pemasok
            </h1>
            <button onclick="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base transition-all duration-300">
                <i class="fas fa-plus mr-2"></i> Tambah Pemasok
            </button>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-3 mb-4">
                    <div class="relative w-full sm:w-64">
                        <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" placeholder="Cari nama pemasok...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Pemasok</th>
                            <th class="py-3 px-6 text-left">Alamat</th>
                            <th class="py-3 px-6 text-left">Telepon</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php
                        $no = 1;
                        foreach ($pemasok as $row):
                        ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 text-left whitespace-nowrap"><?= $no++ ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($row->NamaPemasok) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($row->Alamat) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($row->Telepon) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($row->Email) ?></td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        <button onclick="editPemasok('<?= $row->idPemasok ?>')" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deletePemasok('<?= $row->idPemasok ?>')" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="pemasokModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 id="modalTitle" class="text-xl font-bold">Tambah Pemasok</h2>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900">&times;</button>
            </div>
            <?= form_open('dataPemasok/save', ['id' => 'pemasokForm', 'method' => 'post']) ?>
            <div class="mb-4">
                <label for="id_pemasok" class="block text-gray-700 font-bold mb-2">Id Pemasok</label>
                <input type="text" name="id_pemasok" id="id_pemasok" readonly
                    class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="nama_pemasok" class="block text-gray-700 font-bold mb-2">Nama Pemasok</label>
                <input type="text" name="nama_pemasok" id="nama_pemasok" required
                    class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Masukan nama pemasok">
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" required
                    class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Masukan alamat pemasok"></textarea>
            </div>
            <div class="mb-4">
                <label for="telepon" class="block text-gray-700 font-bold mb-2">Telepon</label>
                <input type="text" name="telepon" id="telepon" required
                    class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Masukan nomor telepon">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Masukan email pemasok">
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
<script>

function openModal() {
    document.getElementById('pemasokModal').classList.remove('hidden');
    document.getElementById('pemasokModal').classList.add('flex');
    document.getElementById('pemasokForm').reset();
    document.getElementById('modalTitle').textContent = 'Tambah Pemasok';
    document.getElementById('id_pemasok').value = '';
}

function closeModal() {
    document.getElementById('pemasokModal').classList.remove('flex');
    document.getElementById('pemasokModal').classList.add('hidden');
}

function editPemasok(id) {
    Swal.fire({
        title: 'Memproses...',
        html: 'Mengambil data pemasok',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`<?= site_url('dataPemasok/get/') ?>${id}`)
        .then(response => response.json())
        .then(data => {
            Swal.close();
            document.getElementById('pemasokModal').classList.remove('hidden');
            document.getElementById('pemasokModal').classList.add('flex');
            document.getElementById('modalTitle').textContent = 'Edit Pemasok';

            document.getElementById('id_pemasok').value = data.idPemasok;
            document.getElementById('nama_pemasok').value = data.NamaPemasok;
            document.getElementById('alamat').value = data.Alamat;
            document.getElementById('telepon').value = data.Telepon;
            document.getElementById('email').value = data.Email;
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Gagal mengambil data pemasok',
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
        });
}

function deletePemasok(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah anda yakin ingin menghapus data pengguna ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Memproses...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            window.location.href = `<?= site_url('dataPemasok/delete/') ?>${id}`;
        }
    });
}


document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchText = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');

    tableRows.forEach(row => {
        const namaPemasok = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const alamat = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const telepon = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

        if (namaPemasok.includes(searchText) || 
            alamat.includes(searchText) || 
            telepon.includes(searchText) || 
            email.includes(searchText)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

document.getElementById('pemasokForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nama = document.getElementById('nama_pemasok').value;
    const alamat = document.getElementById('alamat').value;
    const telepon = document.getElementById('telepon').value;
    const email = document.getElementById('email').value;

    if (!nama || !alamat || !telepon || !email) {
        Swal.fire({
            title: 'Error!',
            text: 'Semua field harus diisi',
            icon: 'error',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        Swal.fire({
            title: 'Error!',
            text: 'Format email tidak valid',
            icon: 'error',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    const teleponPattern = /^\d+$/;
    if (!teleponPattern.test(telepon)) {
        Swal.fire({
            title: 'Error!',
            text: 'Nomor telepon hanya boleh berisi angka',
            icon: 'error',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    Swal.fire({
        title: 'Memproses...',
        html: 'Menyimpan data pemasok',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    this.submit();
});

document.getElementById('pemasokModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('pemasokModal').classList.contains('hidden')) {
        closeModal();
    }
});
</script>