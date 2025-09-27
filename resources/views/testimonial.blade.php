@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'Testimony Client')

@section('content')

    {{-- Header Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-2">Testimony <span class="text-teal-600">Client</span></h2>
            <p class="text-gray-600">Simak Apa Kata Klien</p>
        </div>
    </section>
    
    {{-- Testimonials Grid --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            {{-- <h3 class="text-xl text-teal-600 font-semibold mb-2">PORTFOLIO</h3>
            <h2 class="text-3xl font-bold mb-10">Simak Apa Kata Klien</h2> --}}
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($testimonials as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center text-center">
                        {{-- Avatar Klien (Jika Anda menambahkan kolom avatar di Model Testimonial, gunakan di sini) --}}
                        {{-- Saat ini kita hanya menggunakan placeholder --}}
                        <div class="w-16 h-16 bg-gray-300 rounded-full mb-4 flex items-center justify-center overflow-hidden">
                            {{-- Placeholder untuk avatar --}}
                            <i class="fas fa-user-circle text-4xl text-white"></i>
                        </div>
                        
                        <p class="italic text-gray-700 mb-4 text-left">"{{ $testimonial->content }}"</p>
                        
                        {{-- Detail Klien --}}
                        <div class="mt-auto">
                            <div class="font-bold text-gray-900">{{ $testimonial->client_name }}</div>
                            <div class="text-sm text-teal-600">{{ $testimonial->client_title }}</div>
                        </div>
                    </div>
                @empty
                    <p class="md:col-span-3 text-gray-500">Belum ada testimoni yang ditambahkan. Silakan isi melalui CMS.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection