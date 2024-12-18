<footer class="bg-white dark:bg-gray-900">
    <br>
    <hr class="max-w-screen-xl mx-auto my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
        <div class="mb-6 md:mb-0">
            <a href="/" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" class="h-20 me-3 mr-5" alt="Pelosok Nusantara" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">PELOSOK NUSANTARA</span>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    Resources
                </h2>
                <ul class="text-gray-500 dark:text-gray-400 font-small space-y-4">
                    <li>
                    <a href="{{ route('page.homes.index') }}"
                        class="{{ request()->routeIs('page.homes.index') ? 'text-yellow-500 underline' : 'hover:underline' }}">
                        Home
                    </a>
                    </li>
                    <li>
                    <a href="{{ route('page.about.index') }}"
                        class="{{ request()->routeIs('page.about.index') ? 'text-yellow-500 underline' : 'hover:underline' }}">
                        About
                    </a>
                    </li>
                    <li>
                    <a href="{{ route('page.explore.index') }}"
                        class="{{ request()->routeIs('page.explore.index') ? 'text-yellow-500 underline' : 'hover:underline' }}">
                        Explore
                    </a>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-small">
                    <li class="mb-4">
                        <a target="_blank" href="https://www.facebook.com/" class="hover:underline ">Facebook</a>
                    </li>
                    <li class="mb-4">
                        <a target="_blank" href="https://www.instagram.com/" class="hover:underline">Instagram</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://linkedin.com/" class="hover:underline">LinkedIn</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-small">
                    <li class="mb-4">
                        <a target="_blank" href="#" class="hover:underline">Privacy Policy</a>
                    </li>
                    <li>
                        <a target="_blank" href="#" class="hover:underline">Terms &amp; Conditions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Pelosok Nusantara™</a>. All Rights Reserved.
        </span>
        <div class="flex mt-4 sm:justify-center sm:mt-0">
            <a target="_blank" href="https://www.facebook.com" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                <span class="sr-only">Facebook page</span>
            </a>
            <a target="_blank" href="https://www.instagram.com" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                <span class="sr-only">Instagram</span>
            </a>
            <a target="_blank" href="https://www.linkedin.com" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                </svg>
                <span class="sr-only">LinkedIn</span>
            </a>
        </div>
    </div>
    </div>
</footer>
