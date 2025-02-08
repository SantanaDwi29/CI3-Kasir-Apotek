<div class="flex-1 p-8">
    <!-- <?php
            $Level = $this->session->userdata('Level');
            if ($Level == "Admin") {
                echo "Admin";
            } else {
                echo "Kasir";
            }
            ?> -->
    <?php if ($Level == 'Admin'): ?>
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-6">
                <div class="border-b pb-4">
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fa-solid fa-tablets text-blue-600 mr-3"></i>
                        Form Kategori Obat
                    </h1>
                </div>

                <?= form_open('jenisObat/save', ['id' => 'tambahJenisObatForm', 'method' => 'post', 'class' => 'mt-6']) ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="idjenisObat" class="block text-sm font-medium text-gray-700">Id Kategori Obat</label>
                        <input type="text" name="idjenisObat" id="idjenisObat" readonly
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                    </div>

                    <div class="space-y-2">
                        <label for="namaJenis" class="block text-sm font-medium text-gray-700">Nama Kategori Obat</label>
                        <input type="text" name="namaJenis" id="namaJenis" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan Nama Jenis Obat">
                    </div>
                </div>

                <div class="space-y-2 mt-6">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" required rows="4"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan keterangan kategori obat"></textarea>
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <button type="reset"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Reset
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    <?php endif; ?>
</div>



<script>

    function editJenisObat(id) {
        fetch(`<?= site_url('jenisObat/get/') ?>${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('idjenisObat').value = data.idJenisObat;
                document.getElementById('namaJenis').value = data.JenisObat;
                document.getElementById('keterangan').value = data.Keterangan;

                document.getElementById('tambahJenisObatForm').scrollIntoView({
                    behavior: 'smooth'
                });
                document.getElementById('tambahJenisObatForm').classList.add('ring-2', 'ring-blue-500');
                setTimeout(() => {
                    document.getElementById('tambahJenisObatForm').classList.remove('ring-2', 'ring-blue-500');
                }, 3000);
            })
            .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Gagal mengambil data kategori obat',
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
        });
    }

    function deleteJenisObat(id) {
        Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah anda yakin ingin menghapus data jenis obat ini?",
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
            window.location.href = `<?= site_url('jenisObat/delete/') ?>${id}`;
        }
    });
    }
    document.getElementById('tambahJenisObatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah data yang diinput sudah benar?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Cek Kembali'
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
            this.submit();
        }
    });
});
</script>