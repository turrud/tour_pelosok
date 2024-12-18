@extends('frontend.layout.main')
@section('title', 'Explore')
@section('content')
    <div class="container mx-auto pt-20">
    </div>
    <!-- Halaman Explore -->
    <div class="container max-w-screen-xl mx-auto px-4 py-12">
        <!-- Deskripsi Singkat -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Eksplorasi Keindahan Tersembunyi Indonesia</h1>
            <p class="mt-4 text-gray-600 text-lg">
                Temukan destinasi wisata terbaik di pelosok Indonesia yang belum banyak dikenal, nikmati keindahan alam yang luar biasa dan pengalaman yang tak terlupakan!
            </p>
        </div>

        <!-- Gambar Banner -->
        <div class="mb-12">
            <img src="{{ asset('img/home-explore/4.jpg') }}" alt="Tour Pelosok" class="w-full object-cover rounded-lg">
        </div>

        <!-- Search Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-12 container mx-auto mt-10">
            <div class="flex justify-start mt-4">
                <p style="font-size: 30px">
                    <span class="font-semibold">Cari destinasi wisata</span>
                </p>
                <p class="lg:heading-5 text-gray-100">
                    <span class="font-italic font-mono text-gray-400">Pelosok Nusantara</span>
                </p>
            </div>
            <div class="flex justify-end mt-4">
                <div class="flex w-min md:w-1/2 gap-2">
                    <!-- Camping -->
                    <label class="flex items-center border cursor-pointer w-full bg-gray-400 hover:bg-gray-300 text-gray-100 font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <input type="radio" name="type" value="camping" class="hidden peer">
                        <span class="text-teal-500 mr-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#14b8a6" />
                                <path d="M9 11h6v2H9z" fill="#fff" />
                            </svg>
                        </span>
                        <span class="text-gray-700 font-semibold">Camping</span>
                    </label>

                    <!-- Honeymoon -->
                    <label class="flex items-center border cursor-pointer w-full bg-gray-400 hover:bg-gray-300 text-gray-100 font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <input type="radio" name="type" value="honeymoon" class="hidden peer">
                        <span class="text-green-500 mr-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#5a8f7b" />
                                <path d="M10 11h4v2h-4z" fill="#fff" />
                            </svg>
                        </span>
                        <span class="text-gray-700 font-semibold">Honeymoon</span>
                    </label>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="container mx-auto mt-10">
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Lokasi -->
                            <div>
                                <label for="location" class="block text-gray-700 font-semibold mb-1">Location</label>
                                <select class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                                    <option>Select Location</option>
                                    <option>Bandung</option>
                                </select>
                            </div>
                            <!-- Check-in -->
                            <div>
                                <label for="check_in" class="block text-gray-700 font-semibold mb-1">Check-in</label>
                                <input type="date" id="check_in" class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                            </div>
                            <!-- Check-out -->
                            <div>
                                <label for="check_out" class="block text-gray-700 font-semibold mb-1">Check-out</label>
                                <input type="date" id="check_out" class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                            </div>
                            <!-- Duration -->
                            <div>
                                <label for="duration" class="block text-gray-700 font-semibold mb-1">Duration</label>
                                <input type="text" id="duration" readonly value="1 Night(s)"
                                    class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Button -->
            <a href="{{ route('package.index') }}">
                <div class="flex justify-end mt-4">
                    <button class="bg-gray-200 hover:bg-gray-500 text-gray-100 font-semibold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Search
                    </button>
                </div>
            </a>
        </div>

        <div class="flex justify-start mt-10">
            <p style="font-size: 30px">
                <span class="font-semibold">New Updates for You</span>
            </p>
        </div>
        <p class="lg:heading-5 text-gray-100">
            <span class="font-italic font-mono text-gray-400">See the latest updates and news made specially for you</span>
        </p>

        <!-- List Kartu Wisata -->
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-8 mt-5">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('img/home-explore/1.jpg') }}" alt="Wisata 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">SOON!</h3>
                    <p class="mt-2 text-gray-600">---</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('img/home-explore/2.jpg') }}" alt="Wisata 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">SOON!</h3>
                    <p class="mt-2 text-gray-600">---</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('img/home-explore/3.jpg') }}" alt="Wisata 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">SOON!</h3>
                    <p class="mt-2 text-gray-600">---</p>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const durationInput = document.getElementById('duration');

    // Fungsi menghitung durasi
    function calculateDuration() {
        const checkInValue = checkInInput.value;
        const checkOutValue = checkOutInput.value;

        console.log("Check-in Value:", checkInValue); // Debug
        console.log("Check-out Value:", checkOutValue); // Debug

        if (checkInValue && checkOutValue) {
            const checkInDate = new Date(checkInValue);
            const checkOutDate = new Date(checkOutValue);

            console.log("Check-in Date:", checkInDate); // Debug
            console.log("Check-out Date:", checkOutDate); // Debug

            if (checkOutDate > checkInDate) {
                const timeDiff = checkOutDate - checkInDate;
                const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                console.log("Calculated Duration:", days); // Debug
                durationInput.value = `${days} Night(s)`;
            } else {
                console.warn("Check-out lebih kecil atau sama dengan Check-in.");
                durationInput.value = "1 Night(s)";
            }
        } else {
            console.warn("Tanggal Check-in atau Check-out belum diisi.");
            durationInput.value = "1 Night(s)";
        }
    }

    // Tambahkan event listener untuk input tanggal
    checkInInput.addEventListener('change', calculateDuration);
    checkOutInput.addEventListener('change', calculateDuration);
});
</script>
