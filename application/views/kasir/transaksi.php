<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                <i class="fa-solid fa-clipboard text-blue-600 mr-3"></i>
                Form Transaksi
            </h2>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="useResep" class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2">Gunakan Resep</span>
                </label>
            </div>

            <div id="resepForm" class="hidden mb-4">
                <select id="idResep" class="w-full p-2 border rounded">
                    <option value="">Pilih Resep</option>
                    <?php foreach ($resep as $r): ?>
                        <?php if ($r->Status == 0): ?>
                            <option value="<?= $r->idResep ?>">
                                <?= $r->NamaPelanggan ?> - <?= date('d/m/Y', strtotime($r->TanggalResep)) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>

                <div id="resepDetail" class="mt-3 p-3 bg-gray-50 rounded hidden">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                            <input type="text" id="namaDokter" class="w-full p-2 border rounded bg-gray-100" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                            <input type="text" id="namaPasien" class="w-full p-2 border rounded bg-gray-100" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Pasien</label>
                            <input type="text" id="alamatPasien" class="w-full p-2 border rounded bg-gray-100" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
    <div class="space-y-2">
        <label for="id_obat" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
        <select id="id_obat" name="id_obat" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="" disabled selected>Pilih obat</option>
            <optgroup label="Obat Tersedia">
                <?php foreach ($obat as $o): ?>
                    <?php if ($o->StokObat > 0 && strtotime($o->ExpObat) >= strtotime(date('Y-m-d'))): ?>
                        <option value="<?= $o->idObat ?>" 
                                data-nama="<?= $o->NamaObat ?>"
                                data-kode="<?= $o->KodeObat ?>"
                                data-harga="<?= $o->HargaJual ?>"
                                data-stok="<?= $o->StokObat ?>"
                                data-expired="<?= $o->ExpObat ?>"
                                class="text-black">
                            <?= $o->NamaObat ?> - Stok: <?= $o->StokObat ?>
                        </option>
                    <?php endif; ?>
                </optgroup>
            <?php endforeach; ?>
            
            <optgroup label="Obat Kadaluarsa" class="text-red-600">
                <?php foreach ($obat as $o): ?>
                    <?php if (strtotime($o->ExpObat) < strtotime(date('Y-m-d'))): ?>
                        <option value="<?= $o->idObat ?>" 
                                data-nama="<?= $o->NamaObat ?>"
                                data-kode="<?= $o->KodeObat ?>"
                                data-harga="<?= $o->HargaJual ?>"
                                data-stok="<?= $o->StokObat ?>"
                                data-expired="<?= $o->ExpObat ?>"
                                class="text-red-600">
                            <?= $o->NamaObat ?> (Kadaluarsa: <?= date('d/m/Y', strtotime($o->ExpObat)) ?>)
                        </option>
                    <?php endif; ?>
                </optgroup>
            <?php endforeach; ?>
        </select>
    </div>
</div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="space-y-2">
                    <label for="tanggal_resep" class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
                    <input type="datetime-local" name="tanggal_resep" id="tanggal_resep"
                        class="form-control w-full px-3 py-2 border rounded-md bg-gray-200" readonly>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Nama Obat</label>
                    <input type="text" id="namaObat" class="w-full p-2 border rounded bg-gray-200" readonly>
                    <input type="hidden" id="idObat">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Kode Obat</label>
                    <input type="text" id="kodeObat" class="w-full p-2 border rounded bg-gray-200" readonly>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" id="stokObat" class="w-full p-2 border rounded bg-gray-200" readonly>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" id="hargaObat" class="w-full p-2 border rounded bg-gray-200" readonly>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Jumlah Di Beli</label>
                    <input type="number" id="jumlahBeli" min="1" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <button type="button" id="btnTambah" class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Tambah ke Keranjang
            </button>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                <i class="fa-solid fa-cart-shopping text-green-600 mr-3"></i>
                Keranjang Belanja
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full mb-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="block text-m font-medium text-gray-700 p-2 text-left">Nama Obat</th>
                            <th class=" text-m font-medium text-gray-700 p-2 text-right">Harga</th>
                            <th class="text-m font-medium text-gray-700 p-2 text-right">Jumlah</th>
                            <th class="text-m font-medium text-gray-700 p-2 text-right">Subtotal</th>
                            <th class="text-m font-medium text-gray-700 p-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cartItems"></tbody>
                </table>
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Total:</span>
                    <span id="totalBelanja" class="font-semibold">Rp 0</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Bayar:</span>
                    <input type="number" id="jumlahBayar" class="w-32 p-2 border rounded text-right">
                </div>
                <div class="flex justify-between mb-4">
                    <span class="font-semibold">Kembalian:</span>
                    <span id="kembalian" class="font-semibold text-green-600">Rp 0</span>
                </div>

                <button type="button" id="btnSimpan" value="Selesai dan Cetak" class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600" onclick="selesaidanncetak();">
                    Simpan dan Cetak Nota
                </button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        let cart = [];
        // let searchTimeout;
        $('#useResep').change(function() {
            $('#resepForm').toggleClass('hidden');
            if (!$(this).is(':checked')) {
                $('#resepDetail').addClass('hidden');
                $('#idResep').val('');
                $('#namaDokter').val('');
                $('#namaPasien').val('');
                $('#alamatPasien').val('');
            }
        });

        $('#idResep').change(function() {
            const idResep = $(this).val();
            if (idResep) {
                $.ajax({
                    url: '<?= base_url('transaksi/getResepData') ?>',
                    type: 'POST',
                    data: {
                        idResep
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            $('#namaDokter').val(data.NamaDokter);
                            $('#namaPasien').val(data.NamaPelanggan);
                            $('#alamatPasien').val(data.AlamatPelanggan);
                            $('#resepDetail').removeClass('hidden');
                        } else {
                            Swal.fire('Error', 'Gagal memuat data resep', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat memuat data resep', 'error');
                    }
                });
            }
        });
        $('#id_obat').change(function() {
    const selectedOption = $(this).find('option:selected');
    
    if (selectedOption.val()) {
        const id = selectedOption.val();
        const nama = selectedOption.data('nama');
        const kode = selectedOption.data('kode');
        const harga = selectedOption.data('harga');
        const stok = selectedOption.data('stok');
        const expired = selectedOption.data('expired');
        
        const expiredDate = new Date(expired);
        const today = new Date();
        
        if (expiredDate < today) {
            Swal.fire({
                title: 'Peringatan!',
                text: `Obat ${nama} sudah kadaluarsa pada ${new Date(expired).toLocaleDateString('id-ID')}. Tidak bisa digunakan`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateFormFields(id, nama, kode, harga, stok);
                } else {
                    $(this).val('');
                    clearForm();
                }
            });
        } else {
            updateFormFields(id, nama, kode, harga, stok);
        }
    } else {
        clearForm();
    }
});

        // $('#searchObat').on('input', function() {
        //     clearTimeout(searchTimeout);
        //     const keyword = $(this).val();

        //     if (keyword.length < 2) {
        //         $('#searchResults').html('').addClass('hidden');
        //         return;
        //     }

        //     searchTimeout = setTimeout(function() {
        //         $.ajax({
        //             url: ,
        //             data: {
        //                 term: keyword
        //             },
        //             success: function(response) {
        //                 const data = JSON.parse(response);
        //                 let html = '';

        //                 if (data.length === 0) {
        //                     html = '<div class="p-2 text-gray-500">Tidak ada hasil ditemukan</div>';
        //                 } else {
        //                     data.forEach(item => {
        //                         const tanggalKadaluarsa = new Date(item.ExpObat);
        //                         const hariIni = new Date();
        //                         const sudahKadaluarsa = tanggalKadaluarsa < hariIni;

        //                         const kelasWarna = sudahKadaluarsa ? 'bg-red-100' : 'hover:bg-gray-100';
        //                         const kelasText = sudahKadaluarsa ? 'text-red-600' : '';

        //                         html += `
        //                     <div class="p-2 ${kelasWarna} cursor-pointer ${kelasText}" 
        //                         onclick="selectObat(${item.idObat}, '${item.NamaObat}', '${item.KodeObat}', 
        //                             ${item.HargaJual}, ${item.StokObat}, '${item.ExpObat}')">
        //                         ${item.NamaObat} - Stok: ${item.StokObat}
        //                         ${sudahKadaluarsa ? '<span class="text-red-600 ml-2">(Sudah Kadaluarsa)</span>' : ''}
        //                         <div class="text-sm text-gray-500">Kadaluarsa: ${item.ExpObat}</div>
        //                     </div>`;
        //                     });
        //                 }
        //                 $('#searchResults').html(html).removeClass('hidden');
        //             },
        //             error: function() {
        //                 Swal.fire('Error', 'Gagal melakukan pencarian obat', 'error');
        //             }
        //         });
        //     }, 300);
        // });

        // window.selectObat = function(id, nama, kode, harga, stok, tanggalKadaluarsa) {
        //     const kadaluarsa = new Date(tanggalKadaluarsa);
        //     const hariIni = new Date();

        //     if (kadaluarsa < hariIni) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Obat Kadaluarsa',
        //             text: `${nama} sudah kadaluarsa pada ${tanggalKadaluarsa}. Tidak dapat ditambahkan ke keranjang.`
        //         });
        //         return;
        //     }

        //     $('#idObat').val(id);
        //     $('#namaObat').val(nama);
        //     $('#kodeObat').val(kode);
        //     $('#hargaObat').val(harga);
        //     $('#stokObat').val(stok);
        //     // $('#searchResults').addClass('hidden');
        //     $('#jumlahBeli').val(1).attr('max', stok);
        //     // $('#searchObat').val('');
        // }
        function updateFormFields(id, nama, kode, harga, stok) {
    $('#idObat').val(id);
    $('#namaObat').val(nama);
    $('#kodeObat').val(kode);
    $('#hargaObat').val(harga);
    $('#stokObat').val(stok);
    $('#jumlahBeli').val(1).attr('max', stok);
}
        $('#jumlahBeli').on('input', function() {
            const stok = parseInt($('#stokObat').val()) || 0;
            const jumlah = parseInt($(this).val()) || 0;

            if (jumlah > stok) {
                $(this).val(stok);
                Swal.fire('Peringatan', 'Jumlah melebihi stok tersedia!', 'warning');
            }
            if (jumlah < 1) {
                $(this).val(1);
            }
        });

        $('#btnTambah').click(function() {
            const id = $('#idObat').val();
            const nama = $('#namaObat').val();
            const kode = $('#kodeObat').val();
            const harga = parseFloat($('#hargaObat').val());
            const jumlah = parseInt($('#jumlahBeli').val());
            const stok = parseInt($('#stokObat').val());

            if (!id || !nama) {
                Swal.fire('Error', 'Silakan cari dan pilih obat terlebih dahulu!', 'error');
                return;
            }

            if (!jumlah || jumlah < 1) {
                Swal.fire('Error', 'Jumlah beli tidak valid!', 'error');
                return;
            }

            if (jumlah > stok) {
                Swal.fire('Error', 'Jumlah melebihi stok tersedia!', 'error');
                return;
            }

            const existingItemIndex = cart.findIndex(item => item.idObat === id);
            if (existingItemIndex !== -1) {
                const newJumlah = cart[existingItemIndex].jumlah + jumlah;
                if (newJumlah > stok) {
                    Swal.fire('Error', 'Total jumlah melebihi stok tersedia!', 'error');
                    return;
                }
                cart[existingItemIndex].jumlah = newJumlah;
                cart[existingItemIndex].subtotal = newJumlah * harga;
            } else {
                cart.push({
                    idObat: id,
                    kode,
                    nama,
                    harga,
                    jumlah,
                    subtotal: harga * jumlah //proses transaksi berdasarkan jumlah dibeli dan hargajual
                });
            }

            updateCart();
            clearForm();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Obat berhasil ditambahkan ke keranjang',
                timer: 1500,
                showConfirmButton: false
            });
        });

        function updateCart() {
            let html = '';
            let total = 0;

            cart.forEach((item, index) => {
                html += `
                <tr>
                    <td class="p-2">${item.nama}</td>
                    <td class="p-2 text-right">Rp ${item.harga.toLocaleString()}</td>
                    <td class="p-2 text-right">${item.jumlah}</td>
                    <td class="p-2 text-right">Rp ${item.subtotal.toLocaleString()}</td>
                    <td class="p-2 text-center">
                        <button onclick="removeItem(${index})" class="text-red-500 hover:text-red-700 ">
                            <i class="fas fa-trash-alt cursor-pointer"></i>
                        </button>
                    </td>
                </tr>
            `;
                total += item.subtotal;
            });

            $('#cartItems').html(html);
            $('#totalBelanja').text(`Rp ${total.toLocaleString()}`);
            updateKembalian();
        }

        window.removeItem = function(index) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus item ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    cart.splice(index, 1);
                    updateCart();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Item berhasil dihapus dari keranjang',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        $('#jumlahBayar').on('input', function() {
            updateKembalian();
            const totalBelanja = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const jumlahBayar = parseFloat($(this).val()) || 0;

            if (jumlahBayar < totalBelanja) {
                $('#kembalian').addClass('text-red-600').removeClass('text-green-600');
            } else {
                $('#kembalian').addClass('text-green-600').removeClass('text-red-600');
            }
        });

        function updateKembalian() {
            const total = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const bayar = parseFloat($('#jumlahBayar').val()) || 0;
            const kembalian = bayar - total;
            $('#kembalian').text(`Rp ${kembalian.toLocaleString()}`);
        }

        $('#btnSimpan').on('click', function() {
            const idResep = $('#idResep').val();
            const jumlahBayar = parseFloat($('#jumlahBayar').val()) || 0;
            const totalBelanja = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const isUsingResep = $('#useResep').is(':checked');

            let errors = [];

            if (!cart.length) {
                errors.push('Keranjang belanja masih kosong');
            }

            if (!jumlahBayar) {
                errors.push('Jumlah pembayaran belum diisi');
            } else if (jumlahBayar < totalBelanja) {
                errors.push('Jumlah pembayaran kurang dari total belanja');
            }

            if (isUsingResep) {
                if (!idResep) {
                    errors.push('Silakan pilih resep terlebih dahulu');
                }

                const namaDokter = $('#namaDokter').val();
                const namaPasien = $('#namaPasien').val();
                const alamatPasien = $('#alamatPasien').val();

                if (!namaDokter || !namaPasien || !alamatPasien) {
                    errors.push('Data resep tidak lengkap');
                }
            }

            if (errors.length > 0) {
                Swal.fire({
                    title: 'Validasi Gagal',
                    html: errors.join('<br>'),
                    icon: 'error'
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Transaksi',
                html: `
                <div class="text-left">
                    <p>Total Belanja: Rp ${totalBelanja.toLocaleString()}</p>
                    <p>Jumlah Bayar: Rp ${jumlahBayar.toLocaleString()}</p>
                    <p>Kembalian: Rp ${(jumlahBayar - totalBelanja).toLocaleString()}</p>
                    ${isUsingResep ? `<p>Resep: ${$('#namaPasien').val()}</p>` : ''}
                </div>
            `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan Transaksi',
                        text: 'Mohon tunggu...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.post("<?= base_url('transaksi/simpan') ?>", {
                            idResep: isUsingResep && idResep ? idResep : '',
                            totalHarga: totalBelanja,
                            jumlahBayar: jumlahBayar,
                            cartItems: JSON.stringify(cart)
                        })
                        .done(function(response) {
                            try {
                                const res = JSON.parse(response);
                                if (res.success) {
                                    window.open("<?php echo base_url() ?>transaksi/selesaidancetak", "_self"); //open to cetakpdf
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Transaksi berhasil disimpan'
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Error', res.message, 'error');
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                Swal.fire('Error', 'Gagal memproses response', 'error');
                            }
                        }).fail(function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            Swal.fire('Error', 'Gagal menyimpan transaksi', 'error');
                        });
                }
            });
        });

        function clearForm() {
            $('#idObat').val('');
            $('#namaObat').val('');
            $('#kodeObat').val();
            $('#hargaObat').val('');
            $('#stokObat').val('');
            $('#jumlahBeli').val('');
            // $('#searchObat').val('');
            // $('#searchResults').html('').addClass('hidden');
        }

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

            const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
            document.getElementById('tanggal_resep').value = formattedDateTime;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    });
</script>