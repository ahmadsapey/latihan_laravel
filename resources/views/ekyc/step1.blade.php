<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="text-xl font-semibold mb-4">E-KYC - Langkah 1: Data Pribadi</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc ml-4 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ekyc.storeStep1') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $ekyc->name ?? '') }}" class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $ekyc->nik ?? '') }}" class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $ekyc->tanggal_lahir ?? '') }}" class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded-md p-2">{{ old('alamat', $ekyc->alamat ?? '') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Lanjut Step 2 →
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

