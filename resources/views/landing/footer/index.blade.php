<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Footer Links') }}
        </h2>
    </x-slot>

    <div x-data="footerPage()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Tambah --}}
            <div class="mb-6">
                <button @click="openCreateModal()"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Link
                </button>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Daftar Footer Links</h3>

                    <table class="table-auto w-full border">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-center w-16">Pos</th>
                            <th class="px-4 py-2">Label</th>
                            <th class="px-4 py-2">URL</th>
                            <th class="px-4 py-2 text-center w-24">Status</th>
                            <th class="px-4 py-2 text-center w-40">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $item)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $item->position }}</td>
                                <td class="border px-4 py-2">{{ $item->label }}</td>
                                <td class="border px-4 py-2">{{ $item->url }}</td>

                                <td class="border px-4 py-2 text-center">
                                    <span class="px-2 py-1 rounded text-white {{ $item->status ? 'bg-green-600' : 'bg-red-600' }}">
                                        {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                <td class="border px-4 py-2 text-center">
                                    {{-- EDIT BUTTON --}}
                                    <button @click="openEditModal(@json($item))"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded">
                                        Edit
                                    </button>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.landing.footer.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus link ini?')"
                                                class="px-3 py-1 bg-red-600 text-white rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-------------------------------------- --}}
    {{-- MODAL CREATE --}}
    {{-------------------------------------- --}}
    <div x-show="showCreate"
         x-transition
         class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Tambah Footer Link</h2>

            <form method="POST" action="{{ route('admin.landing.footer.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1">Label</label>
                    <input type="text" name="label" class="border-gray-300 rounded-md w-full" required>
                </div>

                <div>
                    <label class="block mb-1">URL</label>
                    <input type="text" name="url" class="border-gray-300 rounded-md w-full">
                </div>

                <div>
                    <label class="block mb-1">Status</label>
                    <select name="status" class="border-gray-300 rounded-md w-full">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="showCreate=false" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-------------------------------------- --}}
    {{-- MODAL EDIT --}}
    {{-------------------------------------- --}}
    <div x-show="showEdit"
         x-transition
         class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Edit Footer Link</h2>

            <form method="POST" x-bind:action="'/admin/landing/footer/' + editData.id" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1">Label</label>
                    <input type="text" name="label" x-model="editData.label" class="border-gray-300 rounded-md w-full" required>
                </div>

                <div>
                    <label class="block mb-1">URL</label>
                    <input type="text" name="url" x-model="editData.url" class="border-gray-300 rounded-md w-full">
                </div>

                <div>
                    <label class="block mb-1">Status</label>
                    <select name="status" x-model="editData.status" class="border-gray-300 rounded-md w-full">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="showEdit=false" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function footerPage() {
            return {
                showCreate: false,
                showEdit: false,
                editData: {},
                openCreateModal() {
                    this.showCreate = true;
                },
                openEditModal(data) {
                    // If data is a JSON string (Blade @json prints literal object), convert if necessary
                    this.editData = typeof data === 'string' ? JSON.parse(data) : data;
                    this.showEdit = true;
                }
            }
        }
    </script>
</x-app-layout>
