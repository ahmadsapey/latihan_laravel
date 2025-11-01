<X-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Form Edit Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Edit Mahasiswa</h3>
                    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                        <label for="" class="block text-gray-700">Nama</label>
                        <input type="text" name="nama" value="{{ $mahasiswa->nama }}" placeholder="Nama">                        
                        </div>
                        
                        <div class="mb-4">
                        <label for="" class="block text-gray-700">NIM</label>
                        <input type="text" name="nim" value="{{ $mahasiswa->nim }}" placeholder="NIM"
                        class="border px-4 py-2 mb-2 w-full" />
                        </div>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>