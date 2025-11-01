
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Tambah Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-lg">Tambah Mahasiswa</h3>
                        <button id="toggleForm" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </button>
                    </div>
                    
                    <form id="formMahasiswa" method="POST" action="{{ route('mahasiswa.store') }}" class="hidden">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                                <input type="text" name="nama" id="nama" 
                                    class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 
                                    dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 
                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    value="{{ old('nama') }}" required>
                            </div>
                            <div>
                                <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIM</label>
                                <input type="text" name="nim" id="nim"
                                    class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 
                                    dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 
                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    value="{{ old('nim') }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="kelas_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                            <select name="kelas_id" id="kelas_id" 
                                class="w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 
                                dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 
                                focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>
                                        {{ $kls->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 
                                transition duration-200 flex items-center">
                                <i class="fas fa-save mr-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">List Mahasiswa</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($data as $mhs)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ $mhs->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ $mhs->nim }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                            {{ $mhs->kelas->nama_kelas ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('mahasiswa.edit', $mhs->id) }}" 
                                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 
                                                    transition duration-200">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('mahasiswa.destroy', $mhs->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 
                                                        transition duration-200"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada data mahasiswa
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('toggleForm').addEventListener('click', function() {
            const form = document.getElementById('formMahasiswa');
            form.classList.toggle('hidden');
            this.textContent = form.classList.contains('hidden') ? 'Tambah Mahasiswa' : 'Tutup Form';
        });
    </script>
    @endpush
</x-app-layout>