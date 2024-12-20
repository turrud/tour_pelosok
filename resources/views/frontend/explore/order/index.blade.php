@extends('frontend.layout.main')
@section('title', 'Contact')
@section('content')
<div class="container mx-auto pt-20">
</div>

<div class="container max-w-screen-xl mx-auto pt-20 flex items-center justify-center">
    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-4">
        @foreach($paket as $paket)

        <div class="flex flex-col rounded-2xl w-80 bg-[#ffffff] shadow-xl p-4">
            <figure class="flex justify-center items-center rounded-2xl">
                <img src="{{ $paket->image ? \Storage::url($paket->image) : '' }}" alt="{{ $paket->title }}" class="rounded-t-2xl">
            </figure>
            <!---->
            <div class="flex flex-col p-8">
                <div class="text-2xl font-bold   text-[#374151] pb-6">{{ $paket->title }}</div>
                <div class=" text-lg   text-[#374151]">{{ $paket->fasilitas }}</div>
                <div class=" text-lg   text-[#374151]">Rp {{ number_format($paket->price, 0, ',', '.') }} / {{ $paket->duration }} days</div>
                <!---->
            </div>
            <div class="flex justify-end pt-6">
                <button class="bg-[#6a6a6a] text-[#ffffff] w-full font-bold text-base  p-3 rounded-lg hover:bg-gray-500 active:scale-95 transition-transform transform">Try it out!</button>
            </div>
        </div>
        @endforeach

    </div>
</div>


@endsection
