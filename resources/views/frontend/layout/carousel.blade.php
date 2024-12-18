<div class="pt-2"></div>
<div class="container max-w-screen-xl mx-auto px-4 pt-20">
    <!-- Carousel Wrapper -->
    <div id="homes-carousel" class="relative w-full z-10" data-carousel="slide">
        <!-- Carousel items container -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- No Results Message -->
            <div id="no-results" class="hidden absolute inset-0 flex items-center justify-center bg-gray-100 rounded-lg">
                <div class="text-xl text-gray-600 text-center">
                    <p>No homes found for the selected filter.</p>
                    <p>Please try another category.</p>
                </div>
            </div>

            @foreach ($homes as $index => $home)
                <div class="hidden duration-700 ease-in-out carousel-item"
                        data-carousel-item
                        data-tags="{{ $home->taghomes->pluck('id')->join(',') }}">
                    <div class="absolute block w-full h-full">
                        @if ($home->main_image)
                            <img src="{{ Storage::url($home->main_image) }}"
                                    class="absolute block w-full h-full object-cover"
                                    alt="{{ $home->title }}">
                        @elseif ($home->homeImages->isNotEmpty())
                            <img src="{{ Storage::url($home->homeImages->first()->image_path) }}"
                                    class="absolute block w-full h-full object-cover"
                                    alt="{{ $home->title }}">
                        @endif

                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-6">
                            <h2 class="text-2xl font-bold mb-2">
                                <a href="{{ route('page.homes.show', $home->id) }}" class="hover:text-blue-300">
                                    {{ $home->title }}
                                </a>
                            </h2>
                            <p class="mb-2">{{ Str::limit($home->description, 150) }}</p>
                            {{-- <div class="flex flex-wrap gap-2">
                                @foreach ($home->taghomes as $tag)
                                    <span class="px-2 py-1 bg-blue-500 rounded-full text-sm">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- Tag Filter -->
    <div class="tag-filter">
        <button class="tag-button active" data-tag="all">All</button>
        @php
            $uniqueTags = $homes->flatMap(function($home) {
                return $home->taghomes;
            })->unique('id')->values();
        @endphp
        @foreach ($uniqueTags as $tag)
            <button class="tag-button" data-tag="{{ $tag->id }}">
                {{ $tag->name }}
            </button>
        @endforeach
    </div>

</div>

