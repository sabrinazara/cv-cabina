@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'About Us - Our Story')

@section('content')
    
    {{-- Our Story Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-8">My <span class="text-teal-600">Story</span></h2>
            
            <div class="flex justify-center mb-8">
                @if ($profile->photo ?? null)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="rounded-lg shadow-xl w-64 h-auto">
                @else
                    {{-- Ganti dengan gambar placeholder Anda --}}
                @endif
            </div>

            <div class="max-w-4xl mx-auto text-lg text-gray-700 leading-relaxed">
                <p>
                    {{ $profile->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}
                </p>
                <p class="mt-4">
                    {{-- Anda bisa menambahkan deskripsi panjang di sini, diambil dari field lain di ProfileSetting jika ada --}}
                </p>
            </div>
        </div>
    </section>

    {{-- Testimonial Section (Simak Apa Kata Klien) --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-xl text-teal-600 font-semibold mb-2">PORTFOLIO</h3> 
            <h2 class="text-3xl font-bold mb-10">Simak Apa Kata Klien</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($testimonials as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="italic text-gray-700 mb-4">"{{ Str::limit($testimonial->content, 150) }}"</p>
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