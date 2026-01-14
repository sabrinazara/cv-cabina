@extends('layouts.app') 
{{-- Layouts/app.blade.php yang digunakan di sini adalah layout frontend --}}

@section('title', 'About Us - Our Story')

@section('content')

{{-- OUR STORY --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20">
    
    {{-- Header --}}
    <div class="mx-auto max-w-3xl text-center">
      <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
        My <span class="text-teal-600">Story</span>
      </h2>
      <p class="mt-4 text-base leading-relaxed text-gray-600">
        Mengenal lebih dekat perjalanan, pengalaman, dan bidang yang saya tekuni.
      </p>
    </div>

    {{-- Content --}}
    <div class="mt-12 grid items-start gap-10 lg:grid-cols-12">
      
      {{-- Foto --}}
      <div class="lg:col-span-4 flex justify-center lg:justify-start">
        @if ($profile->photo ?? null)
          <img
            src="{{ asset('storage/' . $profile->photo) }}"
            alt="{{ $profile->name ?? 'Profile Photo' }}"
            class="w-72 rounded-2xl object-cover shadow-xl ring-1 ring-gray-200 transition duration-300 hover:scale-[1.02]"
          />
        @else
          <div class="flex h-72 w-72 items-center justify-center rounded-2xl bg-gray-100 text-gray-500 shadow-inner ring-1 ring-gray-200">
            <span class="text-sm">Foto belum tersedia</span>
          </div>
        @endif
      </div>

      {{-- Deskripsi --}}
      <div class="lg:col-span-8">
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
          <h3 class="text-xl font-semibold text-gray-900">
            {{ $profile->name ?? 'Tentang Saya' }}
          </h3>
          <p class="mt-4 text-base leading-relaxed text-gray-700">
            {{ $profile->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
          </p>

          {{-- Jika nanti ada field tambahan (misal long_description), tinggal aktifkan ini --}}
          {{-- 
          @if(!empty($profile->long_description))
            <p class="mt-4 text-base leading-relaxed text-gray-700">
              {{ $profile->long_description }}
            </p>
          @endif 
          --}}
        </div>
      </div>

    </div>
  </div>
</section>


{{-- TESTIMONIAL --}}
<section class="bg-gray-50">
  <div class="mx-auto max-w-7xl px-6 py-16">
    
    <div class="mx-auto max-w-3xl text-center">
      <h3 class="text-sm font-semibold tracking-widest text-teal-600">TESTIMONIAL</h3>
      <h2 class="mt-2 text-3xl font-bold text-gray-900">Simak Apa Kata Klien</h2>
      <p class="mt-3 text-gray-600">
        Beberapa ulasan singkat dari klien yang pernah bekerja sama.
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
      @forelse ($testimonials as $testimonial)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
          <p class="text-sm italic leading-relaxed text-gray-700">
            “{{ Str::limit($testimonial->content, 150) }}”
          </p>

          <div class="mt-5 border-t border-gray-100 pt-4">
            <div class="font-bold text-gray-900">
              {{ $testimonial->client_name }}
            </div>
            <div class="text-sm text-teal-600">
              {{ $testimonial->client_title }}
            </div>
          </div>
        </div>
      @empty
        <p class="md:col-span-3 text-center text-gray-500">
          Belum ada testimoni yang ditambahkan.
        </p>
      @endforelse
    </div>

  </div>
</section>

@endsection
