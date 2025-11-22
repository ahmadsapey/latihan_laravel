<section class="bg-gray-50">
    <!-- MAX WIDTH -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24">

        <!-- GRID: TEXT LEFT - IMAGE RIGHT -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- LEFT SIDE --}}
            <div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Selamat Datang di<br>
                    Platform Pendanaan Syariah
                </h1>

                <p class="mt-6 text-lg text-gray-600 max-w-xl">
                    Mulai perjalanan investasi Anda dengan transparansi dan keamanan melalui layanan kami.
                    Nikmati kemudahan mengelola pendanaan dalam satu platform.
                </p>

                <!-- BUTTON GROUP -->
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('register') }}"
                        class="px-8 py-3 bg-blue-600 text-white text-lg rounded-lg shadow hover:bg-blue-700 transition">
                        Daftar Sekarang
                    </a>

                    <a href="{{ route('login') }}"
                        class="px-8 py-3 text-lg border border-gray-300 text-blue-600 rounded-lg hover:bg-gray-100 transition">
                        Masuk
                    </a>
                </div>

                <!-- BRAND LOGO -->
                <div class="flex flex-wrap items-center gap-8 mt-12 opacity-60">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Airbnb_Logo_Bélo.svg"
                        class="h-6" alt="airbnb">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                        class="h-6" alt="google">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg"
                        class="h-6" alt="microsoft">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg"
                        class="h-7" alt="spotify">
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex justify-center lg:justify-end">
                <img src="{{ asset('storage/image/landing/hero-lp3i.jpg') }}"
                    class="w-[300px] md:w-[420px] lg:w-[500px] drop-shadow-xl" alt="Hero Image">
            </div>

        </div>
    </div>
</section>
