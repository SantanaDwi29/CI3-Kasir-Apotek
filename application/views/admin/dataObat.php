<div class="flex-1 p-8">
    <!-- <?php
            $Level = $this->session->userdata('Level');
            if ($Level == "Admin") {
                echo "Admin";
            } else {
                echo "Kasir";
            }
            ?> -->
    <?php
    if ($Level == 'Admin') {
    ?>
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-6">
                <div class="border-b pb-4">
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-prescription-bottle-alt text-blue-600 mr-3"></i>
                        Form Tambah Obat
                    </h1>
                </div>

                <?= form_open_multipart('dataObat/save', ['id' => 'tambahObatForm', 'method' => 'post', 'class' => 'mt-6']) ?> <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="id_obat" class="block text-sm font-medium text-gray-700">Id Obat</label>
                        <input type="text" name="id_obat" id="id_obat" readonly
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                    </div>
                    <div class="space-y-2">
                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Input</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="<?php echo date('Y-m-d'); ?>" class="form-control w-full px-3 py-2 border rounded-md bg-gray-200" readonly="readonly" />
                    </div>

                    <div class="space-y-2">
                        <label for="id_pemasok" class="block text-sm font-medium text-gray-700">Pemasok</label>
                        <select name="id_pemasok" id="id_pemasok" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Pilih pemasok</option>
                            <?php foreach ($pemasok as $p) { ?>
                                <option value="<?= $p->idPemasok ?>"><?= $p->NamaPemasok ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="kode_obat" class="block text-sm font-medium text-gray-700">Kode Obat</label>
                        <input type="text" name="kode_obat" id="kode_obat" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan kode obat">
                    </div>

                    <div class="space-y-2">
                        <label for="nama_obat" class="block text-sm font-medium text-gray-700">Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan nama obat">
                    </div>

                    <div class="space-y-2">
                        <label for="id_jenisObat" class="block text-sm font-medium text-gray-700">Jenis Obat</label>
                        <select name="id_jenisObat" id="id_jenisObat" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Pilih Jenis Obat</option>
                            <?php foreach ($jenisObat as $j) { ?>
                                <option value="<?= $j->idJenisObat ?>"><?= $j->JenisObat ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="harga_satuan" class="block text-sm font-medium text-gray-700">Harga Satuan (1 Strip)</label>
                        <input type="number" name="harga_satuan" id="harga_satuan" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan harga satuan">
                    </div>

                    <div class="space-y-2">
                        <label for="harga_beli" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                        <input type="number" name="harga_beli" id="harga_beli" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan harga beli">
                    </div>

                    <div class="space-y-2">
                        <label for="harga_jual" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan harga jual">
                    </div>

                    <div class="space-y-2">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" id="stok" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan stok obat">
                    </div>

                    <div class="space-y-2">
                        <label for="expired" class="block text-sm font-medium text-gray-700">Tanggal Expired</label>
                        <input type="date" name="expired" id="expired" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="space-y-2">
                        <label for="foto_obat" class="block text-sm font-medium text-gray-700">Upload Foto</label>
                        <input type="file" name="foto_obat" id="foto_obat" accept="image/*"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div id="preview-container" class="mt-2">
                            <img id="view_gambar" class="hidden max-w-xs rounded-lg shadow-md">
                        </div>
                    </div>
                </div>
                <div class="space-y-2 mt-6">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" required rows="4"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukan keterangan pemakaian obat"></textarea>
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
<?php }
?>
<script language="javascript">
    document.getElementById('foto_obat').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('preview-container');
                let imagePreview = document.getElementById('view_gambar');

                if (!imagePreview) {
                    imagePreview = document.createElement('img');
                    imagePreview.id = 'view_gambar';
                    imagePreview.className = 'max-w-xs rounded-lg shadow-md';
                    previewContainer.appendChild(imagePreview);
                }

                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    function editObat(id) {
        fetch(`<?= site_url('dataObat/get/') ?>${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_obat').value = data.idObat;
                document.getElementById('id_pemasok').value = data.idPemasok;
                document.getElementById('nama_obat').value = data.NamaObat;
                document.getElementById('kode_obat').value = data.KodeObat
                document.getElementById('id_jenisObat').value = data.idJenisObat;
                document.getElementById('harga_satuan').value = data.HargaSatuan;
                document.getElementById('harga_beli').value = data.HargaBeli;
                document.getElementById('harga_jual').value = data.HargaJual;
                document.getElementById('stok').value = data.StokObat;
                document.getElementById('keterangan').value = data.Keterangan;

                if (data.ExpObat) {
                    const expDate = new Date(data.ExpObat);
                    const formattedDate = expDate.toISOString().split('T')[0];
                    document.getElementById('expired').value = formattedDate;
                }

                if (data.FotoObat) {
                    const previewContainer = document.getElementById('preview-container');
                    let imagePreview = document.getElementById('view_gambar');
                    if (!imagePreview) {
                        imagePreview = document.createElement('img');
                        imagePreview.id = 'view_gambar';
                        imagePreview.className = 'max-w-xs rounded-lg shadow-md';
                        previewContainer.appendChild(imagePreview);
                    }
                    imagePreview.src = `<?= base_url('uploads/obat/') ?>${data.FotoObat}`;
                    imagePreview.classList.remove('hidden');
                }

                document.getElementById('tambahObatForm').scrollIntoView({
                    behavior: 'smooth'
                });
                document.getElementById('tambahObatForm').classList.add('ring-2', 'ring-blue-500');
                setTimeout(() => {
                    document.getElementById('tambahObatForm').classList.remove('ring-2', 'ring-blue-500');
                }, 3000);
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

    function deleteObat(id) {
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

                window.location.href = `<?= site_url('dataObat/delete/') ?>${id}`;
            }
        });
    }
    document.getElementById('tambahObatForm').addEventListener('submit', function(e) {
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