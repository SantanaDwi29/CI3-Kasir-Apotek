<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.css">
    <link rel="icon" type="image/png" href="<?= base_url('gambar/logo-white.png') ?>">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen flex items-center justify-center bg-sky-50">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[linear-gradient(120deg,#f0f0f0_1px,transparent_1px)] bg-[length:40px_40px] opacity-20"></div>
    </div>

    <div class="relative w-full max-w-md mx-4 animate-fade-in">
        <div class="relative bg-white rounded-2xl shadow-lg p-8 sm:p-10 border border-sky-100">
            <div class="flex flex-col items-center mb-10 animate-slide-up">
                <div class="w-16 h-16 bg-sky-600 rounded-2xl flex items-center justify-center shadow-sm mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-sky-950">Welcome Back</h1>
                <p class="text-sky-600 mt-2">Please sign in to continue</p>
            </div>

            <form name="proseslogin" method="post" action="<?php echo base_url('loginHalaman/proseslogin'); ?>" class="space-y-6" onsubmit="return validateForm(event)">
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-sky-900">Username</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="username" 
                            name="Username" 
                            class="w-full px-4 py-3 bg-sky-50 border border-sky-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 text-sky-900 placeholder-sky-400 transition-all duration-300"
                            placeholder="Enter your username"
                        >
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-sky-900">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="Password" 
                            class="w-full px-4 py-3 bg-sky-50 border border-sky-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 text-sky-900 placeholder-sky-400 transition-all duration-300"
                            placeholder="Enter your password"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <a href="#" class="text-sm text-sky-600 hover:text-sky-800 transition-colors duration-300">
                        Forgot Password?
                    </a>
                </div>

                <button 
                    type="submit"
                    class="w-full py-3 px-4 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500/20 transition-all duration-300 transform hover:translate-y-[-1px] active:translate-y-[1px]"
                >
                    Sign In
                </button>
            </form>
        </div>
    </div>

    <script>
    function validateForm(event) {
        event.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        
        if (!username) {
            Swal.fire({
                title: 'Error!',
                text: 'Username cannot be empty',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0ea5e9'
            });
            return false;
        }
        
        if (!password) {
            Swal.fire({
                title: 'Error!',
                text: 'Password cannot be empty',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0ea5e9'
            });
            return false;
        }

        document.forms['proseslogin'].submit();
    }

    <?php if ($this->session->flashdata('pesan')) { ?>
        Swal.fire({
            title: 'Notice',
            text: '<?php echo $this->session->flashdata('pesan'); ?>',
            icon: 'info',
            confirmButtonText: 'OK',
            confirmButtonColor: '#0ea5e9'
        });
    <?php } ?>
    </script>
</body>
</html>