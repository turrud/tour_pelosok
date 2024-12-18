<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') Pelosok Nusantara</title>
        <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">


        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

        <!-- Icons -->
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])




        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('scripts')

        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>






        @if (session()->has('success'))
        <script>
            var notyf = new Notyf({dismissible: true})
            notyf.success('{{ session('success') }}')
        </s>
        @endif

        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-screen-xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:justify-between">
                    <!-- Logo and Name -->
                    <div class="flex items-center space-x-3 mb-5">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 me-3 mr-5">
                        <span class="text-lg font-semibold text-gray-900">PELOSOK NUSANTARA</span>
                    </div>

                    <!-- Links Section -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8 md:mt-0 ">
                        <!-- Resources -->
                        <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Resources</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">Home</a></li>
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">About</a></li>
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">Explore</a></li>
                        </ul>
                        </div>

                        <!-- Follow Us -->
                        <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Follow Us</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">Facebook</a></li>
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">Instagram</a></li>
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">LinkedIn</a></li>
                        </ul>
                        </div>

                        <!-- Legal -->
                        <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Legal</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">Privacy Policy</a></li>
                            <li><a href="#" class="text-sm text-gray-600 hover:text-gray-800">Terms & Conditions</a></li>
                        </ul>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="mt-8 border-t border-gray-200 pt-6 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-sm text-gray-600">&copy; 2024 Pelosok Nusantara™. All Rights Reserved.</p>
                <div class="flex space-x-8 mt-4 sm:mt-0">
                    <a href="#" class="text-gray-600 hover:text-gray-800 py-2 ">
                    <span class="sr-only"></span>
                    <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 1 0-11.5 9.9V14.89H8v-2.9h2.5V9.79c0-2.6 1.57-4.02 3.89-4.02 1.13 0 2.31.2 2.31.2v2.54H15.8c-1.3 0-1.7.8-1.7 1.6v1.97h2.88l-.5 2.9h-2.38v7.01A10 10 0 0 0 22 12Z"/>
                    </svg>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 py-2">
                    <span class="sr-only"></span>
                    <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M16 3H8a5 5 0 0 0-5 5v8a5 5 0 0 0 5 5h8a5 5 0 0 0 5-5V8a5 5 0 0 0-5-5Zm3 13a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3v8ZM12 8a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2Zm4-6a1 1 0 1 1 1-1 1 1 0 0 1-1 1Z"/>
                    </svg>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 py-2">
                    <span class="sr-only"></span>
                    <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2ZM8 18H6V9h2v9Zm-1-9.8a1.2 1.2 0 1 1 1.2-1.2A1.2 1.2 0 0 1 7 8.2ZM18 18h-2v-4.5a1.5 1.5 0 0 0-3 0V18h-2V9h2v1.1a3.5 3.5 0 0 1 6 2.4V18Z"/>
                    </svg>
                    </a>
                </div>
                </div>
            </div>
        </footer>

        <script>
            /* Simple Alpine Image Viewer */
            document.addEventListener('alpine:init', () => {
                Alpine.data('imageViewer', (src = '') => {
                    return {
                        imageUrl: src,

                        refreshUrl() {
                            this.imageUrl = this.$el.getAttribute("image-url")
                        },

                        fileChosen(event) {
                            this.fileToDataUrl(event, src => this.imageUrl = src)
                        },

                        fileToDataUrl(event, callback) {
                            if (! event.target.files.length) return

                            let file = event.target.files[0],
                                reader = new FileReader()

                            reader.readAsDataURL(file)
                            reader.onload = e => callback(e.target.result)
                        },
                    }
                })
            })
        </script>
    </body>
</html>
