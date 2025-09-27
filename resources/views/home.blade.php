@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="py-16 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
            {{-- Kiri: Teks Profil --}}
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-4xl font-bold mb-4">
                    {{ $profile->name ?? 'Sabrina Az Zahra' }}, 
                    <span class="text-teal-600" id="typing-text"></span> 
                    {{-- Tambahkan ID untuk ditargetkan oleh JavaScript --}}
                </h1>
                <p class="text-gray-600 mb-6">
                    {{ $profile->description ?? 'Deskripsi default tentang diri Anda.' }}
                </p>
                <a href="{{ route('about') }}" class="bg-teal-600 text-white px-4 py-3 rounded-full hover:bg-teal-700 transition">
                    Read More
                </a>
            </div>
            {{-- Kanan: Foto Profil --}}
            <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center relative"> 
                {{-- **TAMBAHKAN CLASS 'relative' DI SINI** --}}
                {{-- Elemen Grafis di Belakang Foto --}}
                <div class="profile-graphic-shapes">
                    <div></div>
                    <div></div>
                </div>

                @if ($profile->photo ?? null)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" 
                        class="relative z-10 rounded-lg shadow-xl w-60 h-auto object-cover transform hover:scale-105 transition-transform duration-300 custom-border-animation"> 
                    {{-- **TAMBAHKAN CLASS 'relative z-10'** agar foto di atas grafis --}}
                @else
                    {{-- Placeholder jika tidak ada foto --}}
                    <div class="relative z-10 rounded-lg shadow-xl w-64 h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                        <i class="fas fa-user-circle text-6xl"></i>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Service Section (Yang Saya Kerjakan) --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-xl text-teal-600 font-semibold mb-2">SERVICES</h3>
            <h2 class="text-3xl font-bold mb-10">Yang Saya Kerjakan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($services as $service)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                        <i class="{{ $service->icon ?? 'fas fa-wrench' }} text-4xl text-teal-600 mb-4"></i>
                        <h4 class="text-xl font-semibold mb-3">{{ $service->title }}</h4>
                        <p class="text-gray-600 text-sm">{{ Str::limit($service->description, 100) }}</p>
                    </div>
                @empty
                    <p class="md:col-span-3 text-gray-500">Belum ada layanan yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Portfolio Snippet (Lihat Semua Hasil Karya Kami) --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-xl text-teal-600 font-semibold mb-2">PORTOFOLIO</h3>
            <h2 class="text-3xl font-bold mb-10">Project Saya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($items as $item) {{-- UBAH DARI $projects MENJADI $items --}}
                <a href="{{ route('portfolio.show', $item->slug) }}" class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="{{ asset('storage/' . $item->main_image_path) }}" alt="{{ $item->title }}" class="w-full h-64 object-cover transition duration-500 transform group-hover:scale-110">
                    <div class="absolute inset-0 bg-teal-600 bg-opacity-75 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h4 class="text-white text-xl font-bold">{{ $item->title }}</h4>
                    </div>
                </a>
            @empty
                <p class="md:col-span-3 text-gray-500">Belum ada proyek yang ditambahkan.</p>
            @endforelse
        </div>
    </section>

    {{-- Testimonial Snippet (Simak Apa Kata Klien) --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-xl text-teal-600 font-semibold mb-2">TESTIMONIAL</h3>
            <h2 class="text-3xl font-bold mb-10">Simak Apa Kata Klien</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($testimonials->take(3) as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="italic text-gray-700 mb-4">"{{ Str::limit($testimonial->content, 120) }}"</p>
                        <div class="font-bold text-gray-900">{{ $testimonial->client_name }}</div>
                        <div class="text-sm text-teal-600">{{ $testimonial->client_title }}</div>
                    </div>
                @empty
                    <p class="md:col-span-3 text-gray-500">Belum ada testimoni yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
<style>
    .profile-graphic-shapes {
    position: absolute;
    top: 50%; /* Posisikan di tengah vertikal relatif terhadap container */
    left: 50%; /* Posisikan di tengah horizontal relatif terhadap container */
    transform: translate(-50%, -50%); /* Geser agar benar-benar di tengah */
    width: 380px; /* Sedikit lebih besar dari foto (W64 = 256px) */
    height: 380px; /* Sedikit lebih besar dari foto */
    z-index: 1; /* Di belakang foto */
    pointer-events: none; /* Agar tidak menghalangi klik pada foto */
}

.profile-graphic-shapes div {
    position: absolute;
    background: rgba(0, 150, 136, 0.15); /* Warna Teal sedikit lebih pekat */
    border-radius: 50%; /* Bentuk lingkaran */
    filter: blur(8px); /* Blur lebih kuat untuk efek lembut */
    animation: spin 20s linear infinite, scaleAlternate 10s ease-in-out infinite alternate; /* Dua animasi: Putar dan Skala */
}

.profile-graphic-shapes div:nth-child(1) {
    width: 100%; /* Lingkaran pertama sama besar dengan container */
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0.7;
    animation-delay: 0s;
    animation-duration: 25s; /* Durasi putar */
}

.profile-graphic-shapes div:nth-child(2) {
    width: 70%; /* Lingkaran kedua lebih kecil */
    height: 70%;
    top: 15%; /* Posisikan sedikit berbeda */
    left: 15%;
    background: rgba(0, 150, 136, 0.25); /* Warna lebih pekat */
    animation-delay: 3s; /* Delay agar tidak sama */
    animation-duration: 18s; /* Durasi putar */
}

/* Keyframes untuk Animasi Putar (Spin) */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Keyframes untuk Animasi Skala (Pembesar/Pengecil) */
@keyframes scaleAlternate {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); } /* Sedikit membesar */
    100% { transform: scale(1); }
}
</style>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const textElement = document.getElementById('typing-text');
        const dataText = "{{ $profile->title ?? '3D Game Unity' }}";
        const words = [dataText]; 
        
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let speed = 150;

        function type() {
            const currentWord = words[wordIndex % words.length];
            
            if (isDeleting) {
                textElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
                speed = 75;
            } else {
                textElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
                speed = 150;
            }

            if (!isDeleting && charIndex === currentWord.length) {
                speed = 2000;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex++;
                speed = 500;
            }
            setTimeout(type, speed);
        }
        type();
    });
</script>
@endpush