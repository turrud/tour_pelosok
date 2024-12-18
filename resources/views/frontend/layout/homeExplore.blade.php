<div class="container max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
    <!-- Kolom Text -->
    <div class="space-y-4 col-span-1 md:col-span-2 lg:col-span-1">
        <h2 class="text-xl font-bold text-gray-800">
            Selamat Datang di Tour Pelosok - Jelajahi Keindahan Tersembunyi Indonesia!
        </h2>
        <p class="text-sm text-gray-600">
            Temukan destinasi wisata terbaik di pelosok Indonesia yang belum banyak dikenal...
        </p>
        <a class="inline-block" href="/explore">
            <button class="px-4 py-2 bg-gray-200 text-sm text-gray-700 rounded-full hover:bg-gray-300 hover:text-gray-900 transition-colors duration-300">
                Explore
            </button>
        </a>
    </div>

    <!-- Kolom Image 1 -->
    <div class="h-48">
        {{-- <img src="https://placehold.co/400x300" alt="Beach sunset" class="w-full h-full object-cover rounded-lg"> --}}
        <img src="{{ asset('img/home-explore/1.jpg') }}" alt="Beach sunset" class="w-full h-full object-cover rounded-lg">
    </div>

    <!-- Kolom Image 2 -->
    <div class="h-48">
        <img src="{{ asset('img/home-explore/2.jpg') }}" alt="Waterfall" class="w-full h-full object-cover rounded-lg">
    </div>

    <!-- Kolom Image 3 -->
    <div class="h-48">
        <img src="{{ asset('img/home-explore/3.jpg') }}" alt="Forest waterfall" class="w-full h-full object-cover rounded-lg">
    </div>
</div>
