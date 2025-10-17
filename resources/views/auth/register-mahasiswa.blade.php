<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        <h2 class="text-x1 font-semibold text-center mb-6">Register calon mahasiswa</h2>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.mahasiswa') }}">
            @csrf
            
            <div class="mb-4">
                <label for="" class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="border border-gray-300 rounded-md px-3 py-2 w-full" required autofocus>
            </div>

            <div class="mb-4">
                <label for="" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" class="border border-gada erorr di Route [student.dashboard] not defined.ray-300 rounded-md px-3 py-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="" class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="border border-gray-300 rounded-md px-3 py-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="" class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="border border-gray-300 rounded-md px-3 py-2 w-full" required>
            </div>

            <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Register</button>
        <p class="mt-4 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login di sini</a>
        </p>
        
        </form>


    </div>


</x-guest-layout>
    