@extends('frontend.layout.main')
@section('title', 'Explore')
@section('content')
    <div class="container mx-auto pt-20">
    </div>
    <!-- Halaman Explore -->
    <div class="container mx-auto px-4 py-12">
        <!-- Deskripsi Singkat -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Eksplorasi Keindahan Tersembunyi Indonesia</h1>
            <p class="mt-4 text-gray-600 text-lg">
                Temukan destinasi wisata terbaik di pelosok Indonesia yang belum banyak dikenal, nikmati keindahan alam yang luar biasa dan pengalaman yang tak terlupakan!
            </p>
        </div>

        <!-- Gambar Banner -->
        <div class="mb-12">
            <img src="{{ asset('img/home-explore/1.jpg') }}" alt="Tour Pelosok" class="w-full h-64 object-cover rounded-lg">
        </div>

        <!-- List Kartu Wisata -->
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-8 mt-5">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('img/home-explore/1.jpg') }}" alt="Wisata 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Destinasi Wisata 1</h3>
                    <p class="mt-2 text-gray-600">Deskripsi singkat tentang destinasi wisata pertama ini.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('img/home-explore/2.jpg') }}" alt="Wisata 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Destinasi Wisata 2</h3>
                    <p class="mt-2 text-gray-600">Deskripsi singkat tentang destinasi wisata kedua ini.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('img/home-explore/3.jpg') }}" alt="Wisata 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">Destinasi Wisata 3</h3>
                    <p class="mt-2 text-gray-600">Deskripsi singkat tentang destinasi wisata ketiga ini.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
