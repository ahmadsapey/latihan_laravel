@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-5xl p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Mahasiswa</h1>
        <a href="{{ route('mahasiswa.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Tambah Mahasiswa</a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4 border-l-4 border-green-400 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($mahasiswas as $m)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $m->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $m->nim }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $m->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $m->alamat }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ optional($m->kelas)->nama_kelas }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex gap-2">
                                <a href="{{ route('mahasiswa.show', $m->id) }}" class="px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Lihat</a>
                                <a href="{{ route('mahasiswa.edit', $m->id) }}" class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50">
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>
@endsection
