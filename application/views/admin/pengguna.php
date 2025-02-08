<div class="bg-white shadow-md rounded-lg">
    <div class="p-6 border-b flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-user text-blue-600 mr-3"></i>
            Data Pengguna
        </h1>
        <button onclick="openModal()"
            class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm sm:text-base transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Pengguna
        </button>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Lengkap</th>
                        <th class="py-3 px-6 text-left">No Telepon</th>
                        <th class="py-3 px-6 text-left">Level</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($pengguna as $index => $item): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= $index + 1 ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item->NamaLengkap) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item->NoTelepon) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    <?= $item->Level == 'Admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?>">
                                    <?= htmlspecialchars($item->Level) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-3">
                                    <button onclick="editUser(<?= $item->idLogin ?>)"
                                        class="text-blue-600 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteUser(<?= $item->idLogin ?>)"
                                        class="text-red-600 hover:text-red-800 transition-colors">
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

<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md transform transition-all">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-800">Tambah Pengguna</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <?= form_open('pengguna/save', ['id' => 'userForm', 'method' => 'post', 'class' => 'p-6']) ?>
            <input type="hidden" name="id_login" id="id_login">

            <div class="space-y-4">
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan nama lengkap">
                </div>
                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan no telepon pengguna">
                </div>

                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" id="level" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Level</option>
                        <option value="Admin">Admin</option>
                        <option value="Kasir">Kasir</option>
                    </select>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" id="username" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan username pengguna">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password"required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan password pengguna">
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= $this->session->flashdata('success') ?>',
            icon: 'success',
            confirmButtonColor: '#3085d6'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            title: 'Gagal!',
            text: '<?= $this->session->flashdata('error') ?>',
            icon: 'error',
            confirmButtonColor: '#3085d6'
        });
    <?php endif; ?>
});

function openModal() {
    document.getElementById('userModal').classList.remove('hidden');
    document.getElementById('userForm').reset();
    document.getElementById('modalTitle').textContent = 'Tambah Pengguna';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function editUser(id) {
    Swal.fire({
        title: 'Memproses...',
        html: 'Mengambil data pengguna',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`<?= site_url('pengguna/get/') ?>${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            openModal();
            document.getElementById('modalTitle').textContent = 'Edit Pengguna';
            document.getElementById('id_login').value = data.idLogin;
            document.getElementById('nama_lengkap').value = data.NamaLengkap;
            document.getElementById('no_telepon').value = data.NoTelepon;
            document.getElementById('level').value = data.Level;
            document.getElementById('username').value = data.Username;
            Swal.close();
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Gagal mengambil data pengguna',
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
        });
}

function deleteUser(id) {
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
            window.location.href = `<?= site_url('pengguna/delete/') ?>${id}`;
        }
    });
}

document.getElementById('userModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('userModal').classList.contains('hidden')) {
        closeModal();
    }
});
</script>