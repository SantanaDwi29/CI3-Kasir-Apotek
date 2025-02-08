<div class="flex-1 p-8">
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-6">
            <div class="border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-prescription-bottle-alt text-blue-600 mr-3"></i>
                    Form Resep Dokter
                </h1>
            </div>

            <?= form_open('resep/save', ['id' => 'resepForm', 'method' => 'post', 'class' => 'mt-6']) ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="hidden" id="id_resep" name="id_resep" />

                <div class="space-y-2">
                    <label for="tanggal_resep" class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
                    <input type="datetime-local" name="tanggal_resep" id="tanggal_resep"
                        class="form-control w-full px-3 py-2 border rounded-md" readonly />
                </div>

                <div class="space-y-2">
                    <label for="nama_dokter" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" placeholder="Masukkan nama dokter"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="space-y-2">
                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" placeholder="Masukkan nama pasien"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="space-y-2">
                    <label for="alamat_pelanggan" class="block text-sm font-medium text-gray-700">Alamat Pasien</label>
                    <textarea name="alamat_pelanggan" id="alamat_pelanggan" rows="4"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan alamat pasien"></textarea>
                </div>
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
</div>

<script>

    function editResep(id) {
        fetch('<?= base_url('resep/get/') ?>' + id)
    .then(response => response.json())
    .then(data => {
        document.getElementById('id_resep').value = data.idResep;
        document.getElementById('nama_dokter').value = data.NamaDokter;
        document.getElementById('nama_pelanggan').value = data.NamaPelanggan;
        document.getElementById('alamat_pelanggan').value = data.AlamatPelanggan;
        document.getElementById('tanggal_resep').value = data.TanggalResep;
    })
    .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Gagal mengambil data obat',
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
        });
    }

    function deleteResep(id) {
        Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah anda yakin ingin menghapus data obat ini?",
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
            window.location.href = `<?= site_url('resep/delete/') ?>${id}`;
        }
    });
    }
    document.getElementById('resepForm').addEventListener('submit', function(e) {
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
    
    function updateDateTime() {
        function padZero(num) {
            return num < 10 ? "0" + num : num;
        }

        const now = new Date();
        const utc = now.getTime() + now.getTimezoneOffset() * 60000;
        const witaTime = new Date(utc + 8 * 3600000);

        const year = witaTime.getFullYear();
        const month = padZero(witaTime.getMonth() + 1);
        const day = padZero(witaTime.getDate());
        const hours = padZero(witaTime.getHours());
        const minutes = padZero(witaTime.getMinutes());
        const seconds = padZero(witaTime.getSeconds());

        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        document.getElementById('tanggal_resep').value = formattedDateTime;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>