<nav class="flex justify-between items-center px-8 py-4 bg-white shadow-sm">
    <div class="text-2xl font-bold text-blue-600">DSI</div>

    <div class="flex gap-4 items-center">
        @guest
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Register</a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Dashboard</a>
        @endauth
    </div>
</nav>
