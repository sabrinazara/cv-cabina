<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portofolio Developer')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/custom-design.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @stack('styles')
</head>
<body>

    {{-- =============================================== --}}
    {{-- HEADER/NAVIGASI --}}
    {{-- =============================================== --}}
    <header id="main-header" class="fixed top-0 left-0 w-full bg-white z-50 transition-all duration-300 ease-in-out border-b border-transparent">
        <nav class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Cab.CV Logo" class="h-10">
            </a>
            
            <div class="space-x-8 hidden md:flex">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-bold text-teal-600' : 'text-gray-600 hover:text-teal-600' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'font-bold text-teal-600' : 'text-gray-600 hover:text-teal-600' }}">About</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'font-bold text-teal-600' : 'text-gray-600 hover:text-teal-600' }}">Service</a>
                <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'font-bold text-teal-600' : 'text-gray-600 hover:text-teal-600' }}">Portofolio</a>
                <a href="{{ route('testimonial') }}" class="{{ request()->routeIs('testimonial') ? 'font-bold text-teal-600' : 'text-gray-600 hover:text-teal-600' }}">Testimonial</a>
            </div>
            
            @if ($profile->cv_link ?? null)
                <a href="{{ $profile->cv_link }}" class="bg-teal-600 text-white px-4 py-2 rounded-full hover:bg-teal-700 transition">Download CV</a>
            @else
                <button class="bg-teal-600 text-white px-4 py-2 rounded-full opacity-50 cursor-not-allowed">DOWNLOAD CV</button>
            @endif
        </nav>
    </header>
    <div class="pt-16"></div>

    {{-- =============================================== --}}
    {{-- KONTEN UTAMA --}}
    {{-- =============================================== --}}
    <main>
        @yield('content')
    </main>

    {{-- =============================================== --}}
    {{-- FOOTER --}}
    {{-- =============================================== --}}
    <footer class="bg-teal-600 text-white mt-12 py-10">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Kolom 1: Logo, Deskripsi, dan LOKASI --}}
            <div>
                <div class="text-xl font-bold mb-2">About</div>
                <p class="text-sm">3d Designer || Unity Developer</p>
                
                {{-- Tambahan Lokasi di Sini --}}
                <p class="text-sm mt-2 font-bold mb-2">Lokasi:</p>
                <p class="text-sm">Bandar Lampung, Lampung, Indonesia</p>
                
                <p class="text-xs mt-4">Copyright | Faiz Nizar Nu'aim</p>
            </div>
            
            {{-- Kolom 2: Link --}}
            <div>
                <h4 class="font-bold text-lg mb-4">Link</h4>
                <ul>
                    <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:underline">About</a></li>
                    <li><a href="{{ route('services') }}" class="hover:underline">Services</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:underline">Portfolio</a></li>
                    <li><a href="{{ route('testimonial') }}" class="hover:underline">Testimonial</a></li>
                </ul>
            </div>
            
            {{-- Kolom 3: Sosial Media --}}
            <div>
                <h4 class="font-bold text-lg mb-4">Sosial Media</h4>
                <div class="flex space-x-4 text-2xl">
                    <a href="#"><i class="fab fa-facebook-f hover:text-gray-300"></i></a>
                    <a href="#"><i class="fab fa-twitter hover:text-gray-300"></i></a>
                    <a href="#"><i class="fab fa-youtube hover:text-gray-300"></i></a>
                    <a href="#"><i class="fab fa-github hover:text-gray-300"></i></a>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>