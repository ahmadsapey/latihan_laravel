
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Form Tambah Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Tambah Mahasiswa</h3>
                    <form method="POST" action="{{ route('mahasiswa.store') }}">
                        @csrf
                        <input type="text" name="nama" placeholder="Nama"
                        class="border px-4 py-2 mb-2 w-full" />
                        <input type="text" name="nim" placeholder="NIM"
                        class="border px-4 py-2 mb-2 w-full" />

                        <select name="kelas_id" class="border-gray-300 rounded-md w-full">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- List Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">List Mahasiswa</h3>
                    <table class="table-auto w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2 w-16 text-center">No</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">NIM</th>
                                <th class="border px-4 py-2">Kelas</th>
                                <th class="border px-4 py-2 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $mhs)
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <form method="POST" action="{{ route('mahasiswa.destroy', $mhs->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>