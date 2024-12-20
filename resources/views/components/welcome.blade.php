<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex justify-center items-center h-screen">
        <x-application-logo class="block h-12 w-auto" />
    </div>
    <div class="flex justify-center items-center h-screen">
        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Welcome to Pelosok Nusantara!
        </h1>
    </div>


    <p class="mt-6 text-gray-500 leading-relaxed">
        <div class="welcome-message">
            @role('super-admin')
                <p>Hallo, <span class="font-bold">{{ Auth::user()->name }}</span> - You have full access.</p> </p>
            @else
                <p>Hallo, <span class="font-bold">{{ Auth::user()->name }}</span> - You have limited access.</p>
            @endrole
        </div>
    </p>
    <p class="mt-6 text-gray-500 leading-relaxed">
        "Exploring the Hidden Gems of Nusantara"
        Discover the untouched beauty of Indonesia. From Sabang to Merauke, we invite you to experience the wonders of nature, culture, and traditions that captivate the heart.
    </p>
</div>

@role('super-admin')
    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                    <a href="#">About Us</a>
                </h2>
            </div>

            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                "Connecting the Archipelago, Weaving Stories"
            We are here to unveil the hidden beauty of Indonesia. Through meaningful journeys, let’s explore the enchanting wonders of our beloved homeland together.
            </p>

            <p class="mt-4 text-sm">
                <a href="#" class="inline-flex items-center font-semibold text-indigo-700">
                    Explore our stories

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </p>
        </div>

        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                    <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                    <a href="#">Services/Products</a>
                </h2>
            </div>

            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                "Hidden Destinations, Unforgettable Experiences"
            Enjoy exclusive trips to less-known destinations. Get ready to create unforgettable memories surrounded by authentic nature and cultural richness.
            </p>

            <p class="mt-4 text-sm">
                <a href="#" class="inline-flex items-center font-semibold text-indigo-700">
                    Explore our services

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </p>
        </div>

        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                    <a href="https://tailwindcss.com/">Join Us Call-to-Action</a>
                </h2>
            </div>

            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                "Let’s Adventure Together"
            Be part of an inspiring and soul-enriching adventure. Explore Pelosok Nusantara, experience local hospitality, and capture every precious moment.
            </p>
        </div>

        <div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m0 13.5V21m6.364-14.364l-1.591 1.591m-9.546 9.546l-1.591 1.591M21 12h-2.25M5.25 12H3m14.364 6.364l-1.591-1.591m-9.546-9.546L5.636 5.636M12 6.75a5.25 5.25 0 015.25 5.25A5.25 5.25 0 0112 17.25a5.25 5.25 0 01-5.25-5.25A5.25 5.25 0 0112 6.75z" />
                </svg>

                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                    Travel Inspiration
                </h2>
            </div>

            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                "Discover Hidden Paradises in the Homeland"
            From majestic mountains to pristine beaches, every destination is a story waiting to be told. Let’s explore beauty beyond imagination.
            </p>
        </div>
    </div>
    @else
    <div class="bg-gray-200 bg-opacity-25 gap-2 lg:gap-4 p-6 lg:p-2">
        <div id="container" style="width: 100%; height: 500px;">
        </div>
    </div>
@endrole


