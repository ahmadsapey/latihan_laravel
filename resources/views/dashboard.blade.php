<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Poster slider -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Seputar Lp3i Karawang</h3>

                    @if(!empty($images) && count($images) > 0)
                        <div class="relative">
                            <div id="posterSlider" class="w-full h-64 rounded overflow-hidden">
                                @foreach($images as $img)
                                    <img data-src="{{ route('dashboard.image', ['file' => $img]) }}"
                                    src="{{ route('dashboard.image', ['file' => $img]) }}"
                                    class="slider-item w-full h-64 object-cover hidden" alt="poster">
                                @endforeach
                            </div>
                            <div class="absolute right-3 top-3 bg-white bg-opacity-60 rounded px-2 py-1 text-sm">Slide show</div>
                        </div>
                    @else
                        <div class="w-full h-64 bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded">
                            <span class="text-gray-500">Belum ada poster</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- News paragraph -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Berita Singkat</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $newsText ?? 'Belum ada berita.' }}</p>
                </div>
            </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('#posterSlider .slider-item');
            if (!items || items.length === 0) return;
            let idx = 0;
            items.forEach((it, i) => it.classList.add('hidden'));
            items[0].classList.remove('hidden');

            setInterval(() => {
                items[idx].classList.add('hidden');
                idx = (idx + 1) % items.length;
                items[idx].classList.remove('hidden');
            }, 3000);
        });
    </script>
</x-app-layout>
