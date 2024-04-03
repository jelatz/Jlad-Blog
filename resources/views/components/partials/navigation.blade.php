<nav class="p-4">
    <div class="flex justify-between items-center">
        <!-- Logo -->
      <x-logo></x-logo>

        <!-- Hamburger menu for mobile -->
        <button id="menu-toggle" class="focus:outline-none md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Navigation links -->
        <div id="menu" class="hidden md:flex space-x-5">
            {{-- <a href="{{route('contact-us')}}" class="hover:text-red-800 {{request()->routeIs('contact-us') ? 'underline-offset-8 underline' : ''}}">Contact Us</a> --}}
            <a href="{{route('login')}}" class="hover:text-red-800 transition ease-out duration-300 hover:underline {{request()->routeIs('login') ? 'underline-offset-8 underline' : ''}}">Login</a>
            <a href="#" class="hover:text-red-800 transition ease-out duration-300 hover:underline` {{request()->routeIs('register') ? 'underline-offset-8 underline' : ''}}">Register</a>
        </div>
    </div>
</nav>

<!-- Dropdown menu for mobile -->
<div id="mobile-menu" class="md:hidden hidden transition duration-1000 ease-in-out absolute top-50 left-50 z-50  w-full bg-white">
    <div class="mx-auto text-center flex flex-col justify-center items-center">
        <a href="{{route('login')}}" class="py-3 hover:bg-red-800 transition ease-out duration-300 w-full hover:text-white hover:underline {{request()->routeIs('login') ? 'underline-offset-8 underline' : ''}}">Login</a>
        <a href="#" class="py-3 hover:bg-red-800 transition ease-out duration-300 w-full hover:text-white hover:underline` {{request()->routeIs('register') ? 'underline-offset-8 underline' : ''}}">Register</a>
    </div>
</div>