@extends('frontend.layout.main')
@section('title','Detail Paket Wisata')
@section('content')
<div class="container mx-auto pt-20">
    </div>
    <div class="container mx-auto max-w-screen-xl p-4">
        <!-- Gambar Utama -->
        <div class="m-2 flex flex-wrap justify-center items-start relative">
            @if ($package->main_image)
                <img style="height: 600px" src="{{ $package->main_image ? \Storage::url($package->main_image) : '' }}" alt="{{ $package->title }}" class="w-full rounded-lg shadow-lg">
            @endif
        </div>

        <div class="flex flex-wrap justify-center items-start relative">
            <!-- Gambar Kecil di Sekitar Gambar Utama -->
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
        <h1 class="text-3xl font-bold mb-4">{{ $package->title }}</h1>
        <p class="mb-6">{{ $package->description }}</p>

        <div class="mt-6">
            <a href="{{ route('package.index') }}" class="text-blue-500 hover:underline"> Back to Package </a>
        </div>
    </div>
@endsection
