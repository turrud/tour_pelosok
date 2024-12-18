@extends('frontend.layout.main')
@section('title', 'Paket Wisata')
@section('content')
    <div class="container mx-auto pt-20">
    </div>

    <div class="flex justify-end container max-w-screen-xl mx-auto px-4 py-12">
            <a href="{{ route('page.explore.index') }}">
                <p style="font-size: 5px" class="text-gray-100">
                    <span class="font-italic font-mono text-gray-400">Pelosok Nusantara</span>
                </p>
            <p style="font-size: 10px">
                <span class="font-semibold">Back to Explore</span>
            </p>
        </a>
    </div>
    <div class="container max-w-screen-xl mx-auto px-4 py-12">
        <!-- Deskripsi Singkat -->
        <div class="text-center">
            <h1 class="text-3xl font-semibold text-gray-800">Temukan Surga Tersembunyi di Indonesia</h1>
            <p class="mt-4 text-gray-600 text-lg">
                Rasakan petualangan tak terlupakan ke destinasi wisata terbaik yang belum banyak dijamah. Nikmati keajaiban alam yang memukau, budaya autentik, dan momen istimewa yang hanya bisa Anda temukan di pelosok Indonesia. Jadilah bagian dari keindahan yang belum terungkap! 🌿✨
            </p>
        </div>
    </div>
    <div class="container max-w-screen-xl mx-auto py-3">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 px-4">
        <!-- Kolom Pertama: Menu Tag -->
        <div class="col-span-10 p-4 ">
            <h4 class="text-lg font-bold text-gray-800 mb-4">Wisata Pelosok Nusantara</h4>
            <ul class="space-y-2">
                <li>
                    <a href="{{ url()->current() }}?tag=all"
                    class="text-gray-600 hover:underline {{ $selectedTag == 'all' || !$selectedTag ? 'font-bold' : '' }}">
                        All
                    </a>
                </li>
                @foreach ($tags as $tag)
                    <li>
                        <a href="{{ url()->current() }}?tag={{ $tag->id }}"
                        class="text-gray-600 hover:underline {{ $selectedTag == $tag->id ? 'font-bold' : '' }}">
                            {{ $tag->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Kolom Kedua: Card -->
        <div class="col-span-2">
            @foreach ($packages as $package)
            <a href="{{ route('package.show', $package->id) }}">
                <div class="flex bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden mb-3 py-5 pt-5 px-5 hover:bg-gray-50 text-gray-800 font-medium  transition duration-200">
                    <img class="w-48 h-48 object-cover rounded-md " src="{{ $package->main_image ? \Storage::url($package->main_image) : '' }}" alt="{{ $package->title }}">
                    <div class="flex flex-col p-4 w-full">
                        <h5 class="text-md font-semibold text-gray-900">{{ $package->title }}</h5>
                        <p class="text-sm text-gray-500">{{ $package->location ? $package->location->name : 'Bandung' }}</p>

                    </div>
                    <div style="margin-top: 3.5cm" class="flex flex-col items-end container max-w-screen-xl">
                        <span class="text-sm text-gray-500">starts from</span>
                        <p class="text-lg font-bold text-gray-600">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                    </div>

                </div>
            </a>
            @endforeach
        </div>
    </div>

    </div>



@endsection
