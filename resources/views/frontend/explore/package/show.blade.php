@extends('frontend.layout.main')
@section('title','Detail Paket Wisata')
@section('content')
<div class="container mx-auto pt-20">
<div class="container mx-auto max-w-screen-xl p-4">
    <!-- Gambar Utama -->
    <div class="m-2 flex flex-wrap justify-center items-start relative">
        @if ($package->main_image)
            <img style="height: 600px" src="{{ $package->main_image ? \Storage::url($package->main_image) : '' }}" alt="{{ $package->title }}" class="w-full rounded-lg shadow-lg">
        @endif
    </div>

    <!-- Gambar Kecil di Sekitar Gambar Utama -->
    <div class="flex flex-wrap justify-center items-start relative">
        <div class="flex flex-wrap justify-center">
            @if ($package->packageImages->isNotEmpty())
                @foreach ($package->packageImages as $image)
                    <div class="m-2">
                        <img src="{{ $image->image ? \Storage::url($image->image) : '' }}" alt="{{ $image->caption }}" class="w-48 h-32 rounded-lg shadow">
                    </div>
                @endforeach
            @else
                <p class="text-center col-span-2">No images available.</p>
            @endif
        </div>
    </div>

    <!-- Informasi Utama -->
    <h1 class="text-3xl font-bold mb-4">{{ $package->title }}</h1>
    <p class="mb-6">{{ $package->description }}</p>
    <div class="flex justify-end container max-w-screen-xl mx-auto px-4 py-12">
        <a href="{{ route('order.index') }}" class="hover:underline">
            <p style="font-size: 8px" class="text-gray-100">
                <span class="font-italic font-mono text-gray-400">Pelosok Nusantara</span>
            </p>
        <p style="font-size: 15px">
            <span class="font-semibold">Pilih Paket Wisata</span>

        </p>
        </a>
    </div>


    <!-- Hardcoded Tambahan -->
    <div class="mt-8">
        <!-- Informasi Lokasi -->
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
            <p class="text-lg text-gray-800">
                <strong>Alamat:</strong> Jl. Pantai Indah No. 123, Bandung, Indonesia
            </p>
            <p class="text-lg text-gray-800">
                <strong>Kota:</strong> Bandung
            </p>
        </div>

        <!-- Rating -->
        <div class="mt-4">
            <div class="flex items-center mb-4">
                <span class="text-yellow-500 text-2xl">
                    ★★★★☆
                </span>
                <span class="text-gray-600 ml-2 text-lg">4.5 / 5</span>
            </div>
        </div>
    </div>

    <!-- Ulasan Pengguna -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Ulasan Pengguna</h2>
        <div class="space-y-4">
            <!-- Ulasan 1 -->
            <div class="p-4 border border-gray-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-lg">Andi</h3>
                    <span class="text-yellow-500">★★★★☆</span>
                </div>
                <p class="text-gray-600 mt-2">Pantainya sangat indah, cocok untuk bersantai. Saya suka suasananya yang tenang!</p>
                <span class="text-gray-400 text-sm block mt-2">Dibuat pada 15 Desember 2024</span>
            </div>
            <!-- Ulasan 2 -->
            <div class="p-4 border border-gray-200 rounded-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-lg">Mamad</h3>
                    <span class="text-yellow-500">★★★★★</span>
                </div>
                <p class="text-gray-600 mt-2">Sangat menakjubkan! Pemandangan matahari terbenamnya tidak tertandingi.</p>
                <span class="text-gray-400 text-sm block mt-2">Dibuat pada 10 Desember 2024</span>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->

        <div class="flex justify-start container max-w-screen-xl mx-auto px-4 py-12">
            <a href="{{ route('package.index') }}">
                <p style="font-size: 5px" class="text-gray-100">
                    <span class="font-italic font-mono text-gray-400">Pelosok Nusantara</span>
                </p>
            <p style="font-size: 10px">
                <span class="font-semibold">Back to Package</span>
            </p>
            </a>
        </div>
</div>


<!-- Modal -->
<div id="pricingModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-4xl mx-auto rounded-2xl shadow-lg overflow-hidden">
        <!-- Modal Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-bold text-gray-800">Pricing Plans</h2>
            <button id="closeModal" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="flex flex-col lg:flex-row gap-8 p-6">
            <!-- Plan 1 -->
            <div class="flex flex-col rounded-2xl w-full lg:w-1/3 bg-gray-100 text-gray-800 shadow-md">
                <figure class="flex justify-center items-center">
                    <img src="https://via.placeholder.com/150" alt="Plan 1" class="rounded-t-2xl w-full">
                </figure>
                <div class="flex flex-col p-6">
                    <div class="text-2xl font-bold text-center pb-4">Basic</div>
                    <p class="text-center text-gray-600 pb-6">Basic features. Get started completely for free.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Core Features
                        </li>
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Limited Storage
                        </li>
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Ticket Support
                        </li>
                    </ul>
                    <button class="mt-6 w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Get Started
                    </button>
                </div>
            </div>

            <!-- Plan 2 -->
            <div class="flex flex-col rounded-2xl w-full lg:w-1/3 bg-gray-100 text-gray-800 shadow-md">
                <figure class="flex justify-center items-center">
                    <img src="https://via.placeholder.com/150" alt="Plan 2" class="rounded-t-2xl w-full">
                </figure>
                <div class="flex flex-col p-6">
                    <div class="text-2xl font-bold text-center pb-4">Pro</div>
                    <p class="text-center text-gray-600 pb-6">Advanced features for increased productivity.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            All features of the Basic Plan
                        </li>
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Increased Storage
                        </li>
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Advanced Analytics
                        </li>
                    </ul>
                    <button class="mt-6 w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Buy Pro
                    </button>
                </div>
            </div>

            <!-- Plan 3 -->
            <div class="flex flex-col rounded-2xl w-full lg:w-1/3 bg-gray-100 text-gray-800 shadow-md">
                <figure class="flex justify-center items-center">
                    <img src="https://via.placeholder.com/150" alt="Plan 3" class="rounded-t-2xl w-full">
                </figure>
                <div class="flex flex-col p-6">
                    <div class="text-2xl font-bold text-center pb-4">Premium</div>
                    <p class="text-center text-gray-600 pb-6">Exclusive features and priority support for businesses.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            All features of the Pro Plan
                        </li>
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Unlimited Storage
                        </li>
                        <li class="flex items-center">
                            <svg class="text-green-500 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Dedicated Support
                        </li>
                    </ul>
                    <button class="mt-6 w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Buy Premium
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
