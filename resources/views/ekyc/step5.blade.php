<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8 text-center">
        <h2 class="text-xl font-semibold mb-4 text-green-700">E-KYC Selesai ✅</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col items-center justify-center py-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>

            <p class="text-gray-700 mb-3">
                Terima kasih telah menyelesaikan proses registrasi <strong>eKYC</strong>.
            </p>
            <p class="text-gray-600 mb-6">
                Data Anda telah kami terima dan sedang dalam proses verifikasi oleh tim kami.<br>
                Mohon menunggu maksimal <strong>1x24 jam</strong> untuk hasil verifikasi.
            </p>

            <a href="{{ route('ekyc.step1') }}"
               class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                🔄 Cek Lagi
            </a>
        </div>
    </div>
</x-app-layout>
