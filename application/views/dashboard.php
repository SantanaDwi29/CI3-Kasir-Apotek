<?php
$Level = $this->session->userdata('Level');
if ($Level == 'Admin') {
    echo '';
} else {
    echo '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Apotek Assa Farma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="<?= base_url('gambar/logo-white.png') ?>">
    <style>
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            padding-left: 1.5rem;
        }

        .dropdown-menu {
            transition: all 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-gradient-to-br from-blue-800 to-blue-600 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <img src="<?= base_url('gambar/logo-white.png') ?>"
                        alt="Logo Apotek Assa Farma"
                        class="w-14 h-14 mr-3" />
                    <h1 class="text-xl font-bold">Apotek Assa Farma</h1>
                </div>

                <nav class="space-y-2">
                    <a href="<?php echo base_url('dashboard/admin'); ?>"
                        class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                        <i class="fas fa-home w-6 mr-3"></i>
                        <span>Beranda</span>
                    </a>

                    <?php if ($Level == "Admin") { ?>
                        <a href="<?php echo base_url('pengguna'); ?>"
                            class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                            <i class="fa-solid fa-user w-6 mr-3"></i>
                            <span>Pengguna</span>
                        </a>

                        <a href="<?php echo base_url('dataPemasok'); ?>"
                            class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                            <i class="fas fa-users w-6 mr-3"></i>
                            <span>Data Pemasok</span>
                        </a>
                        <div class="relative dropdown" data-dropdown-id="master">
                            <button class="nav-link flex items-center p-3 rounded-lg transition-all duration-300 w-full dropdown-toggle">
                                <i class="fa-solid fa-folder w-6 mr-3"></i>
                                <span>Laporan</span>
                                <i class="fas fa-chevron-down ml-auto transition-transform"></i>
                            </button>
                            <div class="pl-11 space-y-2 mt-1 dropdown-menu hidden">
                                <a href="<?php echo base_url('laporanObat'); ?>"
                                    class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                                    <i class="fas fa-pills w-6 mr-3"></i>
                                    <span>Laporan Obat</span>
                                </a>
                                <a href="<?php echo base_url('laporanTransaksi'); ?>"
                                    class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                                    <i class="fas fa-cash-register  w-6 mr-3"></i>
                                    <span>Laporan Transaksi</span>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="relative dropdown" data-dropdown-id="obat">
                        <button class="nav-link flex items-center p-3 rounded-lg transition-all duration-300 w-full dropdown-toggle">
                            <i class="fas fa-prescription-bottle-alt w-6 mr-3"></i>
                            <span>Obat</span>
                            <i class="fas fa-chevron-down ml-auto transition-transform"></i>
                        </button>
                        <div class="pl-11 space-y-2 mt-1 dropdown-menu hidden">
                            <?php if ($Level == "Admin") { ?>
                                <a href="<?php echo base_url('jenisObat'); ?>"
                                    class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-receipt w-6 mr-3"></i>
                                    <span>Kategori Obat</span>
                                </a>
                            <?php } ?>
                            <a href="<?php echo base_url('dataObat'); ?>"
                                class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                                <i class="fa-solid fa-book-medical w-6 mr-3"></i>
                                <span>Data Obat</span>
                            </a>
                        </div>
                    </div>

                    <a href="<?php echo base_url('resep'); ?>"
                        class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                        <i class="fas fa-file-medical w-6 mr-3"></i>
                        <span>Resep Dokter</span>
                    </a>

                    <a href="<?php echo base_url('transaksi'); ?>"
                        class="nav-link flex items-center p-3 rounded-lg transition-all duration-300">
                        <i class="fas fa-cash-register w-6 mr-3"></i>
                        <span>Transaksi</span>
                    </a>
                </nav>
            </div>

            <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-blue-500/30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3" onclick="toggleProfile()" style="cursor: pointer;">
                        <div class="w-10 h-10 rounded-full bg-blue-500/30 flex items-center justify-center">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <span class="text-sm font-medium truncate max-w-[130px]">
                            <?php echo $this->session->userdata("Username"); ?>
                        </span>
                    </div>
                    <button onclick="confirmLogout('<?php echo base_url('dashboard/logout'); ?>')"
                        class="p-2 hover:text-red-400 transition-colors">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 z-[60] hidden fade-in">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                    <!-- Header Modal -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Profil Pengguna</h3>
                            <button onclick="toggleProfile()" class="text-gray-400 hover:text-gray-500 text-2xl">&times;</button>
                        </div>
                    </div>

                    <!-- Body Modal -->
                    <div class="p-6 space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-3xl text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold"><?php echo $this->session->userdata("Username"); ?></h4>
                                <p class="text-gray-500"><?php echo $this->session->userdata("Level"); ?></p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 text-gray-600">
                                <i class="fas fa-user w-5"></i>
                                <span><?php echo $this->session->userdata("NamaLengkap"); ?></span>
                            </div>
                            <div class="flex items-center space-x-3 text-gray-600">
                                <i class="fas fa-phone w-5"></i>
                                <span><?php echo $this->session->userdata("NoTelepon"); ?></span>
                            </div>
                            <div class="flex items-center space-x-3 text-gray-600">
                                <i class="fas fa-shield-alt w-5"></i>
                                <span><?php echo $this->session->userdata("Level"); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Modal -->
                    <div class="p-6 border-t border-gray-200">
                        <button onclick="toggleProfile()"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="md:hidden fixed top-0 left-0 right-0 bg-gradient-to-r from-blue-800 to-blue-600 text-white p-4 flex justify-between items-center z-40">
            <div class="flex items-center">
                <i class="fa-solid fa-house-chimney-medical text-2xl mr-3"></i>
                <span class="text-xl font-bold">Assa Farma</span>
            </div>
            <button id="mobile-toggle" class="focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64">
            <!-- Dashboard Stats -->
            <div class="fixed md:left-64 left-0 right-0 bg-gray-50 z-30 
                        <?php echo $this->uri->segment(1) == 'dashboard' ? '' : 'hidden'; ?>">
                <div class="p-4 md:p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Stok Obat Card -->
                        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200/60 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Stok Obat</p>
                                    <p class="text-2xl font-semibold"><?= $totalStok ?></p>
                                </div>
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-pills text-yellow-500 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Obat Kadaluarsa Card -->
                        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200/60 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Obat Kadaluarsa</p>
                                    <p class="text-2xl font-semibold text-red-600"><?= $expiredStok ?></p>
                                </div>
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                Dari total <?= $totalStok ?> obat
                            </p>
                        </div>

                        <!-- Transaksi Card -->
                        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200/60 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Transaksi Hari Ini</p>
                                    <p class="text-2xl font-semibold"> Rp. <?= number_format($transaksi_hari_ini, 0, ',', '.') ?></p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-green-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200/60">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center mb-6">
                                <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                                Penjualan 7 Hari Terakhir
                            </h2>
                            <div class="h-96">
                                <canvas id="grafikHarian"></canvas>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200/60">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center mb-6">
                                <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                                Penjualan 4 Minggu Terakhir
                            </h2>
                            <div class="h-96">
                                <canvas id="grafikMingguan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="min-h-screen pt-16 md:pt-0">
                <div class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'mt-[230px] md:mt-[180px]' : 'mt-[60px] md:mt-0'; ?> p-4 md:p-8">
                    <?php
                    if (empty($konten)) {
                        echo "";
                    } else {
                        echo $konten;
                    }
                    ?>

                    <?php
                    if (empty($table)) {
                        echo "";
                    } else {
                        echo $table;
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden md:hidden"></div>
    <script src="<?php echo base_url(); ?>/jquery/app.js"></script>
    <!-- ini untuk memanggil file yang ada pada folder gambar -->
    <script language="javascript">
        var site = "<?php echo base_url() ?>index.php/";
        var loading_image_large = "<?php echo base_url() ?>gambar/loading_large.gif";
        var grafik_harian_labels = <?php echo $grafik_harian_labels; ?>;
        var grafik_harian_data = <?php echo $grafik_harian_data; ?>;
        var grafik_mingguan_labels = <?php echo $grafik_mingguan_labels; ?>;
        var grafik_mingguan_data = <?php echo $grafik_mingguan_data; ?>;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    


    <script>
        function toggleProfile() {
            const modal = document.getElementById('profileModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal when clicking outside
        document.getElementById('profileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleProfile();
            }
        });

        $(document).ready(function() {
            function searchTable() {
                const filter = $("#searchInput").val().toLowerCase();
                const rows = $("#obatTabel tbody tr, #pemasokTabel tbody tr, #resepTabel tbody tr, #tableTransaksi tbody tr");

                rows.each(function() {
                    if (!$(this).hasClass('bg-gray-50')) {
                        let text = '';
                        $(this).find('td:not(:last-child)').each(function() {
                            text += $(this).text().toLowerCase() + ' ';
                        });
                        $(this).toggle(text.includes(filter));
                    }
                });
            }

            $("#searchInput").on("keyup", searchTable);
            $("#btnSearch").on("click", searchTable);

            const dropdowns = $('.dropdown');

            function closeAllDropdowns() {
                dropdowns.each(function() {
                    const menu = $(this).find('.dropdown-menu');
                    const toggle = $(this).find('.dropdown-toggle i.fa-chevron-down');
                    const id = $(this).data('dropdown-id');

                    menu.addClass('hidden');
                    toggle.removeClass('rotate-180');
                    localStorage.removeItem(`dropdown_${id}`);
                });
            }
            $('nav a').on('click', function() {
                closeAllDropdowns();
            });

            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                const dropdown = $(this).closest('.dropdown');
                const id = dropdown.data('dropdown-id');
                const menu = dropdown.find('.dropdown-menu');
                const toggle = $(this).find('i.fa-chevron-down');

                dropdowns.not(dropdown).each(function() {
                    const otherMenu = $(this).find('.dropdown-menu');
                    const otherToggle = $(this).find('.dropdown-toggle i.fa-chevron-down');
                    otherMenu.addClass('hidden');
                    otherToggle.removeClass('rotate-180');
                });

                menu.toggleClass('hidden');
                toggle.toggleClass('rotate-180');

                if (!menu.hasClass('hidden')) {
                    localStorage.setItem(`dropdown_${id}`, 'open');
                } else {
                    localStorage.removeItem(`dropdown_${id}`);
                }
            });

            function toggleSidebar() {
                $('#sidebar').toggleClass('-translate-x-full');
                $('#sidebar-overlay').toggleClass('hidden');
                $('body').toggleClass('overflow-hidden');
            }

            $('#mobile-toggle, #sidebar-overlay').on('click', toggleSidebar);

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    closeAllDropdowns();
                }
            });

            // proses grafik
            if (document.getElementById('grafikHarian')) {
                const ctxHarian = document.getElementById('grafikHarian').getContext('2d');
                new Chart(ctxHarian, {
                    type: 'line',
                    data: {
                        labels: grafik_harian_labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: grafik_harian_data,
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            borderColor: 'rgb(59, 130, 246)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + context.raw.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            }

            if (document.getElementById('grafikMingguan')) {
                const ctxMingguan = document.getElementById('grafikMingguan').getContext('2d');
                new Chart(ctxMingguan, {
                    type: 'bar',
                    data: {
                        labels: grafik_mingguan_labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: grafik_mingguan_data,
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            borderColor: 'rgb(59, 130, 246)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + context.raw.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
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
        window.confirmLogout = function(logoutUrl) {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar dari sistem?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutUrl;
                }
            });
        }

        window.onerror = function(msg, url, lineNo, columnNo, error) {
            console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
            return false;
        };
    </script>
</body>

</html>