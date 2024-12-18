<nav class="bg-white dark:bg-gray-900 fixed w-full z-30 top-0 left-0">
  <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
    <!-- Logo Section -->
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('img/logo.png') }}" style="height: 60px;width: 60px"  alt="Pelosok Nusantara">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
    </a>

    <!-- Mobile Menu Toggle -->
    <button
      class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
      aria-controls="navbar-user" aria-expanded="false" data-collapse-toggle="navbar-user">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>

    <!-- Navigation Menu -->
    <div class="hidden md:flex justify-center flex-1" id="navbar-user">
      <ul
        class="flex flex-col md:flex-row md:space-x-8 font-small border-none md:border-0 bg-gray-50 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent">
        <li>
          <a href="{{ route('page.homes.index') }}"
            class="{{ request()->routeIs('page.homes.index') ? 'text-yellow-500' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:p-0 dark:text-white dark:hover:bg-gray-700">
            Home
          </a>
        </li>
        <li>
          <a href="{{ route('page.about.index') }}"
            class="{{ request()->routeIs('page.about.index') ? 'text-yellow-500' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:p-0 dark:text-white dark:hover:bg-gray-700">
            About
          </a>
        </li>
        <li>
          <a href="{{ route('page.explore.index') }}"
            class="{{ request()->routeIs('page.explore.index') ? 'text-yellow-500' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:p-0 dark:text-white dark:hover:bg-gray-700">
            Explore
          </a>
        </li>
        <li>
          <a href="{{ route('page.contact.index') }}"
            class="{{ request()->routeIs('page.contact.index') ? 'text-yellow-500' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:p-0 dark:text-white dark:hover:bg-gray-700">
            Contact
          </a>
        </li>
      </ul>
    </div>

    <!-- User Dropdown Menu -->
    <div class="relative ml-auto">
      @auth
      <!-- User Avatar Button -->
      <button
        class="flex items-center text-gray-900 dark:text-white focus:outline-none"
        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-menu">
        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
          alt="{{ Auth::user()->name }}" />
        {{-- <span class="ml-2 hidden md:inline-block">{{ Auth::user()->name }}</span> --}}
        <span class="ml-2 md:inline-block">{{ Auth::user()->name }}</span>

      </button>

      <!-- Dropdown Menu -->
      <div id="user-menu"
        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg dark:bg-gray-800 z-50">
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-300">
          <li>
            <a href="{{ route('dashboard') }}"
              class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
          </li>
          <li>
            <a href="#"
              class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
      @else
      <!-- Login Button -->
      <a href="{{ route('register') }}"
        class="text-gray-900 block py-2 px-3 rounded hover:bg-gray-100 md:p-0 dark:text-white dark:hover:bg-gray-700">
        Sign Up
      </a>
      @endauth
    </div>
  </div>

  <!-- Mobile Dropdown Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleButton = document.querySelector('[data-collapse-toggle="navbar-user"]');
      const navbarMenu = document.getElementById('navbar-user');
      const dropdownButton = document.querySelector('[data-dropdown-toggle="user-menu"]');
      const dropdownMenu = document.getElementById('user-menu');

      // Toggle mobile menu
      toggleButton.addEventListener('click', function () {
        navbarMenu.classList.toggle('hidden');
      });

      // Toggle user dropdown
      dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
      });
    });
  </script>
</nav>
