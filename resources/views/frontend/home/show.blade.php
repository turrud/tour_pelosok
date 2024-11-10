@extends('frontend.layout.main')
@section('title','Detail')
@section('content')
    <div class="container mx-auto max-w-screen-xl p-4">
        <!-- Gambar Utama -->
        <div class="m-2 flex flex-wrap justify-center items-start relative">
            @if ($home->main_image)
                <img src="{{ \Storage::url($home->main_image) }}" alt="{{ $home->title }}" class="w-full h-auto rounded-lg shadow-lg">
            @endif
        </div>

        <div class="flex flex-wrap justify-center items-start relative">
            <!-- Gambar Kecil di Sekitar Gambar Utama -->
            <div class="flex flex-wrap justify-center">
                @if ($home->homeImages->isNotEmpty())
                    @foreach ($home->homeImages as $image)
                        <div class="m-2">
                            <img src="{{ \Storage::url($image->image) }}" alt="{{ $image->caption }}" class="w-48 h-32 rounded-lg shadow">
                        </div>
                    @endforeach
                @else
                    <p class="text-center col-span-2">No images available.</p>
                @endif
            </div>
        </div>
        <h1 class="text-3xl font-bold mb-4">{{ $home->title }}</h1>
        <p class="mb-6">{{ $home->description }}</p>

        <div class="mt-6">
            <a href="{{ route('page.homes.index') }}" class="text-blue-500 hover:underline"> Back to Home </a>
        </div>
    </div>
@endsection
